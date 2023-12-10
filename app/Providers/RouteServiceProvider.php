<?php

// namespace App\Providers;

// use Illuminate\Cache\RateLimiting\Limit;
// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\RateLimiter;
// use Illuminate\Support\Facades\Route;

// class RouteServiceProvider extends ServiceProvider
// {
//     /**
//      * The path to your application's "home" route.
//      *
//      * Typically, users are redirected here after authentication.
//      *
//      * @var string
//      */
//     // public const HOME = '/recruiter/dashboard';
//     if (Auth::guard('admin')->check()) {
//         define('HOME', '/admin/dashboard');
//     } elseif (Auth::guard('recruiter')->check()) {
//         define('HOME', '/recruiter/dashboard');
//     } elseif (Auth::guard('job_seeker')->check()) {
//         define('HOME', '/job_seeker/dashboard');
//     } else {
//         // Default or handle unauthenticated users
//     }
    

//     /**
//      * Define your route model bindings, pattern filters, and other route configuration.
//      */
//     public function boot(): void
//     {
//         RateLimiter::for('api', function (Request $request) {
//             return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
//         });

//         $this->routes(function () {
//             Route::middleware('api')
//                 ->prefix('api')
//                 ->group(base_path('routes/api.php'));

//             Route::middleware('web')
//                 ->group(base_path('routes/web.php'));
//         });
//     }
// }

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Set the HOME constant dynamically based on the authenticated user's guard
        if (auth()->guard('admin')->check()) {
            define('HOME', '/admin/dashboard');
        } elseif (auth()->guard('recruiter')->check()) {
            define('HOME', '/recruiter/dashboard');
        } elseif (auth()->guard('job_seeker')->check()) {
            define('HOME', '/job_seeker/dashboard');
        } else {
            // Default or handle unauthenticated users
        }
    }
}

