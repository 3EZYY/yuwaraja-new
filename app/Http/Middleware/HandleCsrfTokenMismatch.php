<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class HandleCsrfTokenMismatch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (TokenMismatchException $e) {
            // Rate limiting for CSRF attacks
            $key = 'csrf_attempts:' . $request->ip();
            if (RateLimiter::tooManyAttempts($key, 5)) {
                Log::warning('CSRF Attack Detected - Rate Limited', [
                    'ip' => $this->sanitizeIp($request->ip()),
                    'attempts' => RateLimiter::attempts($key),
                ]);
                
                return $this->handleRateLimited($request);
            }
            
            RateLimiter::hit($key, 300); // 5 minutes window

            // Secure logging - sanitize sensitive data
            Log::warning('CSRF Token Mismatch', [
                'path' => $this->sanitizePath($request->path()),
                'method' => $request->method(),
                'ip' => $this->sanitizeIp($request->ip()),
                'user_agent_hash' => hash('sha256', $request->userAgent() ?? ''),
                'timestamp' => now()->toISOString(),
            ]);

            // Get safe redirect URL
            $safeRedirectUrl = $this->getSafeRedirectUrl($request);

            // For AJAX requests, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sesi Anda telah berakhir. Silakan refresh halaman dan coba lagi.',
                    'error' => 'csrf_token_mismatch',
                    'redirect' => $safeRedirectUrl
                ], 419);
            }

            // For regular requests, redirect with user-friendly message
            return response()->view('errors.419', [], 419);
        }
    }

    /**
     * Sanitize IP address for logging
     */
    private function sanitizeIp(string $ip): string
    {
        // Hash the last octet for privacy while keeping network info
        $parts = explode('.', $ip);
        if (count($parts) === 4) {
            $parts[3] = 'xxx';
            return implode('.', $parts);
        }
        
        // For IPv6 or invalid IPs, return hashed version
        return substr(hash('sha256', $ip), 0, 8);
    }

    /**
     * Sanitize URL path for logging
     */
    private function sanitizePath(string $path): string
    {
        // Remove sensitive parameters and limit length
        $cleanPath = preg_replace('/[?&]token=[^&]*/', '', $path);
        $cleanPath = preg_replace('/[?&]password=[^&]*/', '', $cleanPath);
        
        return substr($cleanPath, 0, 100);
    }

    /**
     * Get safe redirect URL to prevent open redirects
     */
    private function getSafeRedirectUrl(Request $request): string
    {
        $currentUrl = $request->url();
        $appUrl = config('app.url');
        
        // Only allow redirects to same domain
        if (parse_url($currentUrl, PHP_URL_HOST) === parse_url($appUrl, PHP_URL_HOST)) {
            return $currentUrl;
        }
        
        // Fallback to safe default
        return $appUrl . '/admin/login';
    }

    /**
     * Handle rate limited requests
     */
    private function handleRateLimited(Request $request): Response
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Terlalu banyak percobaan. Silakan tunggu beberapa menit.',
                'error' => 'rate_limited'
            ], 429);
        }

        return redirect('/admin/login')
            ->with('error', 'Terlalu banyak percobaan. Silakan tunggu beberapa menit.');
    }
}
