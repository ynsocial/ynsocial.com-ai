<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiSecurityMiddleware
{
    /**
     * Maximum requests per minute per IP
     */
    private const MAX_REQUESTS_PER_MINUTE = 60;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get client IP
        $ip = $request->ip();
        
        // Rate limiting
        $key = "api_rate_limit:{$ip}";
        $requests = Cache::get($key, 0);
        
        if ($requests >= self::MAX_REQUESTS_PER_MINUTE) {
            Log::warning("Rate limit exceeded for IP: {$ip}");
            return response()->json([
                'error' => 'Too many requests',
                'message' => 'Please try again later'
            ], 429);
        }
        
        // Increment request count
        Cache::add($key, 1, 60);
        Cache::increment($key);

        // Security headers
        $response = $next($request);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Content-Security-Policy', "default-src 'self'");
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // CORS headers for API routes
        if ($request->is('api/*')) {
            $response->headers->set('Access-Control-Allow-Origin', config('app.frontend_url'));
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Max-Age', '86400');
        }

        // Log suspicious requests
        if ($this->isSuspiciousRequest($request)) {
            Log::warning('Suspicious request detected', [
                'ip' => $ip,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'payload' => $request->all()
            ]);
        }

        return $response;
    }

    /**
     * Check if request looks suspicious
     */
    private function isSuspiciousRequest(Request $request): bool
    {
        // Check for common SQL injection patterns
        $sqlPatterns = [
            '/UNION\s+SELECT/i',
            '/OR\s+1=1/i',
            '/DROP\s+TABLE/i',
            '/INFORMATION_SCHEMA/i'
        ];

        $input = json_encode($request->all());
        foreach ($sqlPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }

        // Check for suspicious file uploads
        if ($request->hasFile('*')) {
            $files = $request->allFiles();
            $suspiciousExtensions = ['php', 'exe', 'sh', 'bat', 'cmd', 'dll', 'jsp', 'asp'];
            
            foreach ($files as $file) {
                if (in_array(strtolower($file->getClientOriginalExtension()), $suspiciousExtensions)) {
                    return true;
                }
            }
        }

        // Check for excessive payload size
        if (strlen($input) > 1000000) { // 1MB
            return true;
        }

        // Check for suspicious headers
        $suspiciousHeaders = [
            'HTTP_PROXY',
            'HTTP_VIA',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED_HOST',
            'HTTP_X_FORWARDED_PROTO'
        ];

        foreach ($suspiciousHeaders as $header) {
            if ($request->server->has($header)) {
                return true;
            }
        }

        return false;
    }
} 