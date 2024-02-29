<?php
use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Admin;
use App\Models\Recruiter;
use App\Models\JobSeeker;
use App\Models\Setting; 
use App\Models\LoginHistory; 
use App\Models\GeneralInformation; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

function generateOTP($length = 6) {
    $min = pow(10, $length - 1); // Minimum value: 100000 for 6 digits
    $max = pow(10, $length) - 1; // Maximum value: 999999 for 6 digits
    return strval(mt_rand($min, $max)); 
}
//Calling procedure example: generateOTP();

function storeOTP($user_id, $user_type, $otp_code, $valid_till, $purpose) {
    // Create a new OTP instance and assign values
    $otp = new OTP();
    $otp->user_id = $user_id;
    $otp->user_type = $user_type;
    $otp->otp_code = $otp_code;
    $otp->valid_till = $valid_till;
    $otp->purpose = $purpose;
    $otp->save();

    return $otp;
}
//Calling procedure example: storeOTP($user->id, 'recruiter', $otp_code, now()->addMinutes(5), 'Withdrawal');

function settings($key, $defaultValue = null) {
    $setting = Setting::where('key', $key)->first();
    if ($setting) {
        return $setting->value;
    }
    return $defaultValue; 
}
//Calling procedure example: settings('website');


function generalInformation($key, $defaultValue = null) {
    $infoExists = GeneralInformation::where('key', $key)->first();
    if ($infoExists) {
        return $infoExists->value;
    }
    return $defaultValue; 
}
//Calling procedure example: generalInformation('brand');


function insertLoginHistory($userType) {
    $user = Auth::guard($userType)->user();

    if ($userType !== '') {
        $sessionId = Request::session()->getId();
        $loginTime = Carbon::now();
        // $ipAddress = Request::ip(); // IP address from the request
        $ipAddress = Request::server('REMOTE_ADDR'); // IP address from the request
        $deviceInfo = Request::header('User-Agent'); // Device info from the request headers
        $logoutTime = null; 

        $loginHistory = new LoginHistory();
        $loginHistory->user_id = $user->id;
        $loginHistory->user_type = $userType;
        $loginHistory->session_id = $sessionId;
        $loginHistory->login_time = $loginTime;
        $loginHistory->ip_address = $ipAddress;
        $loginHistory->device_info = $deviceInfo;
        $loginHistory->logout_time = $logoutTime;

        $loginHistory->save();
    }

    return true;
}
//Calling procedure example: insertLoginHistory($this->guard);

        
       
