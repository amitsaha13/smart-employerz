<?php

namespace App\Http\Controllers\JobSeeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\JobSeeker;
use Auth;

class JobSeekerAuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/job_seeker/dashboard';
    protected $guard = 'job_seeker';

    public function showLoginForm()
    {
        return view('job_seeker.job_seeker-login');
    }

    public function login(Request $request)
    {
        $user = Auth::guard('job_seeker')->user();

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
        return view('job_seeker.job_seeker-register');
    }

    protected function register(Request $request)
    {
        $admin = new JobSeeker();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = Hash::make($request['password']);
        $admin->save();

        return redirect('/job_seeker/login');
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout(); // Logout the admin user
        return redirect('/job_seeker/login');
    }


    
    public function index()
    {
        $user = Auth::guard('job_seeker')->user();
        return view('job_seeker.job_seeker-dashboard');
    }
}
