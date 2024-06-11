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
        try {
            if (Auth::guard($this->guard)->check()) {
                // dd('already logged in');
                // If authenticated, redirect to the home page or any desired URL
                // return redirect($this->redirectTo);
                return redirect()->back();
            }
            return view('recruiter.recruiter-login');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function login(Request $request)
    {
        
        try {
            // If not authenticated, proceed with the login attempt
            $credentials = $request->only('email', 'password');

            if (Auth::guard($this->guard)->attempt($credentials, $request->filled('remember'))) {
                // Authentication passed...
                insertLoginHistory($this->guard);
                return redirect()->intended($this->redirectTo)->with('success', 'Login successful!');
            }
            return redirect()->back()->withInput($request->only('email', 'remember'));
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function showRegistrationForm()
    {
        try {
            return view('recruiter.recruiter-register');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function getOTPVerification()
    {
        try {
            return view('verification.otp-verification');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }
    public function mailVerification(Request $request)
    {
        try {
            $email = $request->email ?? Session::get('email'); 
            Session::put('email',$email);
            // Generate OTP and store it in the database
            $otpGeneration = storeOTP(0, 'recruiter', 0);
            // Store requested data in session
            if (!Session::get('registration_data')) {
                Session::put('registration_data', $request->all());
            }
            Session::put('registration_otp', $otpGeneration);

            $customMessage = 'Insert this OTP to verify '.$otpGeneration->otp_code ;
            $toEmail = $request->email;
            $subject = 'Email Verification';
            // Mail::send('emails.my_email', ['subject' => $subject, 'customMessage' => $customMessage], function ($message) use ($toEmail, $subject) {
            //     $message->to($toEmail)
            //         ->subject($subject);
            // });
            return view('verification.otp-verification');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    protected function register(Request $request)
    {
        
        try {
            $OTP_Details = Session::get('registration_otp');
            $submittedOTP = "{$request->otp1}{$request->otp2}{$request->otp3}{$request->otp4}{$request->otp5}";

            if (!$OTP_Details) {
                Session::flash('error', 'Invalid OTP');
                return view('verification.otp-verification');
            }
            if ($OTP_Details->otp_code != $submittedOTP) {
                Session::flash('error', 'OTP does not match');
                return view('verification.otp-verification');
            }
            if ($OTP_Details->valid_till < Carbon::now()) {
                Session::flash('error','OTP Expired');
                return view('verification.otp-verification');
            }

            $storedOTP = OTP::where('token', $OTP_Details->token)
                    ->where('purpose', '0') // 0 for Registration
                    ->where('is_verified', 0)
                    ->first();

            $storedOTP->is_verified = 1;
            $storedOTP->save();

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
            $admin->email_verified_at = Carbon::now();
            $admin->save();

            // Clear the session data
            $request->session()->flush();

            return redirect('/')->with('success', 'Registration successful!');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
        
    }

    
    public function logout(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }


    //Authentication routes for Google
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        } 
    }

    //Authentication routes for Linkedin
    public function redirectToLinkedIn()
    {
        try {
            return Socialite::driver('linkedin')->redirect();
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function handleLinkedInCallback(Request $request)
    {
        try {
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
    
            return redirect('/recruiter/dashboard'); 
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }
    

    //Authentication routes for Microsoft
    public function redirectToMicrosoft()
    {
        try {
            return Socialite::driver('microsoft')->redirect();
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function handleMicrosoftCallback(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }


    public function getResetPassword(Request $request)
    {
        try {
            return view('recruiter.auth.forget-password');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function resetPasswordSendOTP(Request $request)
    {
        try {
            $email = $request->email ?? Session::get('email'); 
            Session::put('email',$email);

            $emailExists = Recruiter::where('email',$email)
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
            Session::put('reset_password_data', $otpGeneration);
            $customMessage = 'Insert this OTP to verify '.$otpGeneration->otp_code ;
            $toEmail = $email;
            $subject = 'Email Verification';
            Mail::send('emails.my_email', ['subject' => $subject, 'customMessage' => $customMessage], function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                    ->subject($subject);
            });
            
            return view('recruiter.auth.otp-verification');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }

    }

    public function resetPasswordMailVerification(Request $request)
    {
        try {
            $OTP_Details = Session::get('reset_password_data');
            $submittedOTP = "{$request->otp1}{$request->otp2}{$request->otp3}{$request->otp4}{$request->otp5}";

            if (!$OTP_Details) {
                Session::flash('error', 'Invalid OTP');
                return view('recruiter.auth.otp-verification');
            }
            if ($OTP_Details->otp_code != $submittedOTP) {
                Session::flash('error', 'OTP does not match');

                return view('recruiter.auth.otp-verification');
            }
            if ($OTP_Details->valid_till < Carbon::now()) {
                Session::flash('error','OTP Expired');
                return view('recruiter.auth.otp-verification');
            }

            $storedOTP = OTP::where('token', $OTP_Details->token)
                    ->where('purpose', '1') // 1 for change password
                    ->where('user_id', $OTP_Details->user_id)
                    ->where('is_verified', 0)
                    ->first();

            $storedOTP->is_verified = 1;
            $storedOTP->save();

            return redirect('recruiter/update-password');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
        
    }

    public function getUpdatePassword()
    {
        try {
            return view('recruiter.auth.set-new-password');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function passwordUpdate(Request $request)
    {
        try {
            $user_id = Session::get('reset_password_data')->user_id;
            $email = Session::get('email');

            $recruiter = Recruiter::find($user_id);
            $recruiter->password = Hash::make($request->password);
            $recruiter->save();

            Session::forget(['reset_password_data', 'email']);

            return redirect('/')->with('success','Password updated successfully');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
        
    }
}



