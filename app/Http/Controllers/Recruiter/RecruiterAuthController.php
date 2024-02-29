<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Toastr;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Recruiter;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendOTPMail;
use App\Mail\JobSeekerMail;


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

        // If not authenticated, proceed with the login attempt
        $credentials = $request->only('email', 'password');

        if (Auth::guard($this->guard)->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            insertLoginHistory($this->guard);
            return redirect()->intended($this->redirectTo)->with('success', 'Login successful!');

        }
        
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showRegistrationForm()
    {
        return view('recruiter.recruiter-register');
    }
    public function sendEmail()
    {
        $toEmail = 'amitsahaami.dev@gmail.com';
        $subject = 'Subject of the email';
        
        $customMessage = 'Insert this OTP to verify '.generateOTP() ;

        // Sending the email with a Blade view
        Mail::send('emails.my_email', ['subject' => $subject, 'customMessage' => $customMessage], function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                ->subject($subject);
        });

        return 'Email sent successfully!';
    }
    protected function register(Request $request)
    {
        $this->sendEmail();
        // dd($request->all());
        $admin = new Recruiter();
        $admin->email = $request->email;
        $admin->password = Hash::make($request['password']);
        $admin->mobile = $request->mobile;
        $admin->company_name = $request->company_name;
        $admin->industry_type = $request->industry_type;
        $admin->employee_count = $request->employee_count;
        $admin->location = $request->location;
        $admin->save();

        return redirect('/')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        $user = Auth::guard($this->guard)->user();
        $sessionId = $request->session()->getId();

        // Get the user's last login record for update
        $lastLogin = LoginHistory::where('user_id', $user->id)
            ->where('user_type', 'recruiter') 
            ->where('session_id', $sessionId)
            ->orderBy('login_time', 'desc')
            ->first();

        if ($lastLogin) {
            $lastLogin->logout_time = Carbon::now(); 
            $lastLogin->save();
        }

        Auth::guard($this->guard)->logout(); // Logout the user

        return redirect('/')->with('success', 'Logout successful!');
    }


    //Authentication routes for Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if a user with this Google ID exists in your database
        $user = Recruiter::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // User doesn't exist, create a new one
            $user = new Recruiter();
            $user->company_name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->google_id = $googleUser->getId();
            $user->mobile = '-';
            $user->industry_type = '-';
            $user->employee_count = '1-10';
            $user->location = '-';
            $user->status = '1';

            $user->save();
        }

        // Log the user in
        Auth::guard('recruiter')->login($user);

        insertLoginHistory($this->guard);

        return redirect('/recruiter/dashboard'); 
    }

    //Authentication routes for Linkedin
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback(Request $request)
    {
        $linkedinUser = Socialite::driver('linkedin')->user();

        // Check if a user with this LinkedIn ID exists in your database
        $user = Recruiter::where('linkedin_id', $linkedinUser->getId())->first();

        if (!$user) {
            // User doesn't exist, create a new one
            $user = new Recruiter();
            $user->company_name = $linkedinUser->getName();
            $user->email = $linkedinUser->getEmail();
            $user->linkedin_id = $linkedinUser->getId();
            // Add other necessary fields
            $user->mobile = '-';
            $user->industry_type = '-';
            $user->employee_count = '1-10';
            $user->location = '-';
            $user->status = '1';

            $user->save();
        }

        // Log the user in
        Auth::guard('recruiter')->login($user);
        insertLoginHistory($this->guard);

        return redirect('/recruiter/dashboard'); // Redirect to the desired page after login
    }

    //Authentication routes for Microsoft
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback(Request $request)
    {
        $microsoftUser = Socialite::driver('microsoft')->user();

        // Check if a user with this Microsoft ID exists in your database
        $user = Recruiter::where('microsoft_id', $microsoftUser->getId())->first();

        if (!$user) {
            // User doesn't exist, create a new one
            $user = new Recruiter();
            $user->company_name = $microsoftUser->getName();
            $user->email = $microsoftUser->getEmail();
            $user->microsoft_id = $microsoftUser->getId();
            // Add other necessary fields
            $user->mobile = '-';
            $user->industry_type = '-';
            $user->employee_count = '1-10';
            $user->location = '-';
            $user->status = '1';
            
            $user->save();
        }

        // Log the user in
        Auth::guard('recruiter')->login($user);
        insertLoginHistory($this->guard);

        return redirect('/recruiter/dashboard');
    }
}



