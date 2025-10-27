<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Configure the rate limiters for the application.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiter للتسجيل
        RateLimiter::for('registration', function (Request $request) {
            return Limit::perMinutes(10, 3) // 3 محاولات كل 10 دقائق
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'Too many registration attempts. Please try again in 10 minutes.',
                        'retry_after' => $headers['Retry-After']
                    ], 429);
                });
        });

        // Rate limiter للدخول
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5) // 5 محاولات كل دقيقة
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message' => 'Too many login attempts. Please try again in 60 seconds.',
                        'retry_after' => $headers['Retry-After']
                    ], 429);
                });
        });
    }
}