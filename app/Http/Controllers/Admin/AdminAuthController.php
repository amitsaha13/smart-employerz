<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Auth;
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
            return redirect()->intended($this->redirectTo);
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout(); // Logout the admin user
        return redirect('admin/login');
    }


    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.admin-dashboard');
    }
}
