<?php

// namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Http\Request;

// class Authenticate extends Middleware
// {
    
//     protected function redirectTo(Request $request): ?string
//     {
//         return $request->expectsJson() ? null : route('login');//recruiter login page
//     }
// }


namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $guard = auth()->getDefaultDriver();

        // return $guard;

        switch ($guard) {
            case 'admin':
                return route('admin.dashboard');
                break;
            case 'recruiter':
                return route('recruiter.dashboard');
                break;
            case 'job_seeker':
                return route('job_seeker.dashboard');
                break;
            default:
                return route('login');
        }
    }
}


