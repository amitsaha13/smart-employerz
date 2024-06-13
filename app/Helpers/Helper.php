<?php
use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Admin;
use App\Models\Recruiter;
use App\Models\JobSeeker;
use App\Models\Setting; 
use App\Models\LoginHistory; 
use App\Models\GeneralInformation; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Storage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


function generateOTP($length = 5) {
    $min = pow(10, $length - 1); // Minimum value: 100000 for 6 digits
    $max = pow(10, $length) - 1; // Maximum value: 999999 for 6 digits
    return strval(mt_rand($min, $max)); 
}
//Calling procedure example: generateOTP();

function storeOTP($user_id, $user_type, $purpose) {
    // Create a new OTP instance and assign values
    $otp = new OTP();
    $otp->user_id = $user_id;
    $otp->user_type = $user_type;
    $otp->token = Str::uuid();
    $otp->otp_code = generateOTP(5);
    $otp->valid_till = now()->addMinutes(5);
    $otp->purpose = $purpose;
    $otp->save();

    return $otp;
}
//Calling procedure example: storeOTP($user->id, 'recruiter', '0');

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

function numberToWord($number) {
    $words = [
        '', 'One', 'Two', 'Three', 'Four', 
        'Five', 'Six', 'Seven', 'Eight', 'Nine', 
        'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 
        'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    ];

    $tens = [
        '', '', 'Twenty', 'Thirty', 'Forty', 
        'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
    ];
    if ($number == 0) {
        return 'Zero';
    }elseif ($number < 20) {
        return $words[$number];
    } elseif ($number < 100) {
        return $tens[floor($number / 10)] . ' ' . $words[$number % 10];
    } else {
        return 'Number out of range';
    }
}

function LogErrors($exception)
{
    try {
        $logs = [
            'error' => $exception->getMessage(),
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
        ];
        $currentMonthYear = Carbon::now()->format('Y-m');
        
        //Public Path
        // $logFilePath = public_path('logs/Errors/'.$currentMonthYear.'.log');
    
        //Storage Path
        $logFilePath = storage_path('logs/Errors/'.$currentMonthYear.'.log');
    
        // Ensure the directory exists
        $logDirectory = dirname($logFilePath);
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0755, true);
        }
    
        $writeLog = new Logger('SE');
        $writeLog->pushHandler(new StreamHandler($logFilePath, Logger::ERROR));
        $writeLog->error('SE Log', $logs);
    
        return true;
    } catch (\Throwable $th) {
        return view('400');
    }
}

function calculateAge($dateOfBirth) {
    // Create a DateTime object from the date of birth
    $dob = new DateTime($dateOfBirth);
    // Get the current date
    $now = new DateTime();
    // Calculate the difference between the current date and the date of birth
    $age = $now->diff($dob);
    // Return the age in years
    return $age->y;
}