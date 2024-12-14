<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Authentication required'
            ], 401);
        }

        $user = Auth::user();
        $userRoles = $this->getUserRoles($user->id);

        // Check if user has any of the required roles
        $hasRole = false;
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            Log::warning('Unauthorized access attempt', [
                'user_id' => $user->id,
                'required_roles' => $roles,
                'user_roles' => $userRoles,
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);

            return response()->json([
                'error' => 'Forbidden',
                'message' => 'Insufficient permissions'
            ], 403);
        }

        // Add role information to request for controllers
        $request->merge(['user_roles' => $userRoles]);

        // Log access for sensitive operations
        if ($this->isSensitiveOperation($request)) {
            Log::info('Sensitive operation performed', [
                'user_id' => $user->id,
                'roles' => $userRoles,
                'operation' => $request->method() . ' ' . $request->path(),
                'ip' => $request->ip()
            ]);
        }

        return $next($request);
    }

    /**
     * Get user roles with caching
     */
    private function getUserRoles(int $userId): array
    {
        $cacheKey = "user_roles:{$userId}";
        
        return Cache::remember($cacheKey, 3600, function () use ($userId) {
            // Fetch roles from database with relationships
            $user = Auth::user()->load('roles');
            return $user->roles->pluck('name')->toArray();
        });
    }

    /**
     * Check if the request is for a sensitive operation
     */
    private function isSensitiveOperation(Request $request): bool
    {
        $sensitivePatterns = [
            '/^admin\/users/i',
            '/^admin\/settings/i',
            '/^admin\/roles/i',
            '/^admin\/permissions/i',
            '/delete$/i',
            '/destroy$/i',
            '/update$/i'
        ];

        foreach ($sensitivePatterns as $pattern) {
            if (preg_match($pattern, $request->path())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Clear user roles cache
     */
    public static function clearRolesCache(int $userId): void
    {
        Cache::forget("user_roles:{$userId}");
    }
} 