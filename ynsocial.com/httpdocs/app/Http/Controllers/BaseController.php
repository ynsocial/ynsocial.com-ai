<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Exception;
use Throwable;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Default cache duration in seconds (1 hour)
     */
    protected int $cacheDuration = 3600;

    /**
     * Default pagination per page
     */
    protected int $perPage = 15;

    /**
     * Success response
     */
    protected function successResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error response
     */
    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    /**
     * Handle database operations with error handling
     */
    protected function handleDatabaseOperation(callable $operation)
    {
        try {
            return $operation();
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage(), [
                'exception' => $e,
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);
            
            return $this->errorResponse(
                'Database operation failed',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        } catch (Exception $e) {
            Log::error('Operation error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            
            return $this->errorResponse(
                'Operation failed',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Get cached data or execute callback
     */
    protected function getCachedData(string $key, callable $callback)
    {
        return Cache::remember($key, $this->cacheDuration, $callback);
    }

    /**
     * Clear cache for specific key or pattern
     */
    protected function clearCache(string $key): void
    {
        if (str_contains($key, '*')) {
            Cache::tags($key)->flush();
        } else {
            Cache::forget($key);
        }
    }

    /**
     * Handle model operations with proper error responses
     */
    protected function handleModelOperation(Model $model, callable $operation, string $successMessage = 'Operation successful')
    {
        try {
            $result = $operation($model);
            return $this->successResponse($result, $successMessage);
        } catch (Throwable $e) {
            Log::error('Model operation error: ' . $e->getMessage(), [
                'model' => get_class($model),
                'operation' => debug_backtrace()[1]['function'],
                'exception' => $e
            ]);
            
            return $this->errorResponse(
                'Operation failed',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Validate and sanitize input data
     */
    protected function validateAndSanitize(array $data, array $rules, array $messages = []): array
    {
        $validator = validator($data, $rules, $messages);

        if ($validator->fails()) {
            throw new Exception(
                'Validation failed: ' . implode(', ', $validator->errors()->all()),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $validator->validated();
    }

    /**
     * Handle file upload with proper error handling
     */
    protected function handleFileUpload(string $path, $file, array $allowedTypes = [], int $maxSize = 5242880)
    {
        try {
            if (!$file->isValid()) {
                throw new Exception('Invalid file upload');
            }

            if (!empty($allowedTypes) && !in_array($file->getMimeType(), $allowedTypes)) {
                throw new Exception('Invalid file type');
            }

            if ($file->getSize() > $maxSize) {
                throw new Exception('File size exceeds limit');
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $filename, 'public');

            return $filename;
        } catch (Exception $e) {
            Log::error('File upload error: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'path' => $path,
                'exception' => $e
            ]);
            
            throw $e;
        }
    }

    /**
     * Log activity with context
     */
    protected function logActivity(string $action, array $context = []): void
    {
        $user = auth()->user();
        
        Log::info("Activity: {$action}", array_merge([
            'user_id' => $user ? $user->id : null,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ], $context));
    }

    /**
     * Handle API rate limiting
     */
    protected function handleRateLimit(string $key, int $maxAttempts = 60, int $decayMinutes = 1): bool
    {
        $attempts = Cache::get($key, 0) + 1;
        Cache::put($key, $attempts, now()->addMinutes($decayMinutes));

        if ($attempts > $maxAttempts) {
            throw new Exception(
                'Too many attempts',
                Response::HTTP_TOO_MANY_REQUESTS
            );
        }

        return true;
    }
} 