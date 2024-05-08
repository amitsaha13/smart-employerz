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
use App\Models\OTP;
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
    public function mailVerification(Request $request)
    {
        // Generate OTP and store it in the database
        $otpGeneration = storeOTP(0, 'recruiter', 0);
        // Store requested data in session
        $request->session()->put('registration_data', $request->all());

        $customMessage = 'Insert this OTP to verify '.$otpGeneration->otp_code ;
        $toEmail = $request->email;
        $subject = 'Email Verification';
        Mail::send('emails.my_email', ['subject' => $subject, 'customMessage' => $customMessage], function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                ->subject($subject);
        });
        return view('verification.otp-verification');
    }

    protected function register(Request $request)
    {
        
        $storedOTP = OTP::where('user_id', 0)
                ->where('purpose', '0')
                ->where('user_type', 'recruiter')
                ->where('valid_till', '>', Carbon::now())
                ->where('is_verified', 0)
                ->orderBy('id','DESC')
                ->first();

        $submittedOTP = "{$request->otp1}{$request->otp2}{$request->otp3}{$request->otp4}{$request->otp5}";
        // dd($storedOTP , $submittedOTP,session('registration_data') );
        if ($storedOTP && $storedOTP->otp_code == $submittedOTP) {
            // Retrieve requested data from session
            $registrationData = session('registration_data');

            // Create a new Recruiter instance and save the data
            $admin = new Recruiter();
            $admin->email = $registrationData['email'];
            $admin->password = Hash::make($registrationData['password']);
            $admin->mobile = $registrationData['mobile'];
            $admin->company_name = $registrationData['company_name'];
            $admin->industry_type = $registrationData['industry_type'];
            $admin->employee_count = $registrationData['employee_count'];
            $admin->location = $registrationData['location'];
            $admin->save();

            // Clear the session data
            $request->session()->forget('registration_data');

            return redirect('/')->with('success', 'Registration successful!');
        } else {
            // Handle incorrect OTP scenario
            return redirect('/')->with('error', 'Invalid OTP, please try again.');
        }
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


    public function getResetPassword(Request $request)
    {
        return view('recruiter.auth.forget-password');
    }

    public function resetPasswordSendOTP(Request $request)
    {
        $emailExists = Recruiter::where('email',$request->email)
                ->whereNotNull('email_verified_at')
                ->where('status', 1)
                ->first();

        if (!$emailExists) {
            return redirect()->back()->with('error','Email does not exists');
        }

        if ($request->session()->has('error')) {
            return view('recruiter.auth.otp-verification');
        }
        $otpGeneration = storeOTP($emailExists->id, 'recruiter', 1); //1 for Change Password
        $token = $otpGeneration->token ;
        $request->session()->put('reset_token', $token);

        $customMessage = 'Insert this OTP to verify '.$otpGeneration->otp_code ;
        $toEmail = $request->email;
        $subject = 'Email Verification';
        Mail::send('emails.my_email', ['subject' => $subject, 'customMessage' => $customMessage], function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                ->subject($subject);
        });

        return view('recruiter.auth.otp-verification');

    }

    public function resetPasswordMailVerification(Request $request)
    {
        $storedOTP = OTP::where('token', $request->session()->get('reset_token'))
                ->where('purpose', '1') // 1 for change password
                ->where('user_type', 'recruiter')
                ->where('valid_till', '>', Carbon::now())
                ->where('is_verified', 0)
                ->orderBy('id','DESC')
                ->first();
        
        $submittedOTP = "{$request->otp1}{$request->otp2}{$request->otp3}{$request->otp4}{$request->otp5}";

        if (!$storedOTP){
            return redirect()->back()->with('error','Invalid OTP');
        }
        if ($storedOTP->otp_code != $submittedOTP) {
            return redirect()->back()->with('error','OTP does not match');
        }

        $storedOTP->is_verified = 1;
        $storedOTP->save();

        return redirect('recruiter/update-password');
        
    }

    public function getUpdatePassword()
    {
        return view('recruiter.auth.set-new-password');
    }

    public function passwordUpdate(Request $request)
    {
        $storedOTP = OTP::where('token', $request->session()->get('reset_token'))
                ->where('purpose', '1') // 1 for change password
                ->where('user_type', 'recruiter')
                ->where('is_verified', 1)
                ->orderBy('id','DESC')
                ->first();
        // dd($request->all(), $storedOTP);
        $update = Recruiter::where('id',$storedOTP->user_id)->update(['password' =>Hash::make($request->password)]);
        // dd($update);
        return view('recruiter.auth.set-new-password')->with('success','Password updated successfully');
        
    }
}



