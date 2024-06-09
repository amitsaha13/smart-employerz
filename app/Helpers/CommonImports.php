<?php

// Namespace and use statements can be added as necessary.

use Illuminate\Support\Facades\Log;
// use Toastr;
use Laravel\Socialite\Facades\Session;
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
