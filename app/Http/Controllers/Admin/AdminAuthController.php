<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\LoginHistory;

class AdminAuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/dashboard';
    protected $guard = 'admin';

    public function showLoginForm()
    {
        return view('admin.admin-login');
    }

    public function showRegistrationForm()
    {
        return view('admin.admin-register');
    }

    protected function register(Request $request)
    {
        
        $admin = new Admin();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = Hash::make($request['password']);
        $admin->save();

        return redirect('admin/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Use the attempt method for the admin guard
        if (Auth::guard($this->guard)->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            $user = Auth::guard('admin')->user();
            $sessionId = $request->session()->getId();
            insertLoginHistory($user->id, 'admin', $sessionId, Carbon::now(), $request->ip(), $request->userAgent());

            return redirect()->intended($this->redirectTo);
        }
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $user = Auth::guard($this->guard)->user();
        $sessionId = $request->session()->getId();
        // Get the user's last login record for update
        $lastLogin = LoginHistory::where('user_id', $user->id)
            ->where('user_type', 'admin') 
            ->where('session_id', $sessionId)
            ->orderBy('login_time', 'desc')
            ->first();

        if ($lastLogin) {
            $lastLogin->logout_time = Carbon::now(); 
            $lastLogin->save();
        }
        Auth::guard($this->guard)->logout(); // Logout the admin user
        return redirect('admin/login');
    }


    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.admin-dashboard');
    }
}
