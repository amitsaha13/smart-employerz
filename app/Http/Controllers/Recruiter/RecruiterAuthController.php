<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\Recruiter;
use Auth;

class RecruiterAuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/recruiter/dashboard';
    protected $guard = 'recruiter';

    public function showLoginForm()
    {
        if (Auth::guard($this->guard)->check()) {
            // dd('already logged in');
            // If authenticated, redirect to the home page or any desired URL
            // return redirect($this->redirectTo);
            return redirect()->back();
        }
        return view('recruiter.recruiter-login');
    }

    public function login(Request $request)
    {
        $user = Auth::guard('recruiter')->user();

        // If not authenticated, proceed with the login attempt
        $credentials = $request->only('email', 'password');

        if (Auth::guard($this->guard)->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showRegistrationForm()
    {
        return view('recruiter.recruiter-register');
    }

    protected function register(Request $request)
    {
        $admin = new Recruiter();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = Hash::make($request['password']);
        $admin->save();

        return redirect('/');
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout(); // Logout the admin user
        return redirect('');
    }


    
    public function index()
    {
        $user = Auth::guard('recruiter')->user();
        return view('recruiter.recruiter-dashboard');
    }
}

