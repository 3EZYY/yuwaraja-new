<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        // Trust all proxies for HTTPS detection
        $middleware->trustProxies(at: '*', headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST | \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT | \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle 419 CSRF Token Mismatch
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session expired, silakan refresh halaman',
                    'error' => 'csrf_token_mismatch',
                    'code' => 419
                ], 419);
            }

            // For web requests, show alert and redirect
            return redirect()->back()
                ->with('error', 'Session expired, silakan refresh halaman')
                ->with('show_alert', true);
        });

        // Handle 404 Not Found
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Halaman tidak ditemukan',
                    'error' => 'page_not_found',
                    'code' => 404
                ], 404);
            }

            // For web requests, show custom 404 page
            return response()->view('errors.404', [], 404);
        });
    })->create();
