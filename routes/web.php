<?php
use Illuminate\Support\Facades\Route;

// Auth::routes();


// Admin
use App\Http\Controllers\Admin\AdminAuthController;

//Recruiter
use App\Http\Controllers\Recruiter\RecruiterAuthController;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\JobCircularController;
use App\Http\Controllers\Recruiter\JobSeekerManagementController;

//JobSeeker
use App\Http\Controllers\JobSeeker\JobSeekerAuthController;
use App\Http\Controllers\JobSeeker\JobApplicationController;



/*========= Recruiter routes==============
==========---------------------=========*/
Route::middleware(['guest:recruiter'])->group(function () {
    Route::get('/', [RecruiterAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [RecruiterAuthController::class, 'login'])->name('recruiter.login');

    Route::get('/recruiter/register', [RecruiterAuthController::class, 'showRegistrationForm'])->name('recruiter.register');
    Route::get('/recruiter/register/get-otp', [RecruiterAuthController::class, 'getOTPVerification'])->name('recruiter.register.getotp');
    Route::post('/recruiter/register/mail-verification', [RecruiterAuthController::class, 'mailVerification'])->name('recruiter.register.mail.verification');
    Route::post('/recruiter/register', [RecruiterAuthController::class, 'register'])->name('recruiter.register');
    
    Route::get('/recruiter/reset-password', [RecruiterAuthController::class, 'getResetPassword'])->name('recruiter.reset.password');
    Route::post('/recruiter/reset-password/send-otp', [RecruiterAuthController::class, 'resetPasswordSendOTP'])->name('recruiter.reset.password.send.otp');
    Route::get('/recruiter/reset-password/mail-verification', [RecruiterAuthController::class, 'resetPasswordMailVerification'])->name('recruiter.reset.password.mail.verification');
    
    Route::get('/recruiter/update-password', [RecruiterAuthController::class, 'getUpdatePassword'])->name('recruiter.change.password');
    Route::post('/recruiter/update-password', [RecruiterAuthController::class, 'passwordUpdate'])->name('recruiter.update.password');

    //Authentication routes for Google
    Route::get('/auth/google',[RecruiterAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback',[RecruiterAuthController::class, 'handleGoogleCallback'] );
    
    //Authentication routes for Linkedin
    Route::get('/auth/linkedin',[RecruiterAuthController::class, 'redirectToLinkedIn'])->name('auth.linkedin');
    Route::get('/auth/linkedin/callback',[RecruiterAuthController::class, 'handleLinkedInCallback'] );

    //Authentication routes for Facebook
    Route::get('/auth/facebook',[RecruiterAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('/auth/facebook/callback',[RecruiterAuthController::class, 'handleFacebookCallback'] );


    //Authentication routes for Microsoft
    Route::get('/auth/microsoft',[RecruiterAuthController::class, 'redirectToMicrosoft'])->name('auth.microsoft');
    Route::get('/auth/microsoft/callback',[RecruiterAuthController::class, 'handleMicrosoftCallback'] );


    Route::get('/delete/profile', [RecruiterAuthController::class, 'deleteProfile']);


});

Route::middleware(['auth:recruiter'])->group(function () {
    // Recruiter dashboard or other authenticated routes
    Route::get('/recruiter/dashboard', [DashboardController::class, 'index'])->name('recruiter.dashboard');
    Route::get('/create-new-job', [JobCircularController::class, 'index'])->name('create.new.job');
    Route::post('/create-new-job', [JobCircularController::class, 'postCreateNewJob'])->name('create.new.job');
    
    // All Jobs
    Route::get('/recruiter/all-jobs', [JobCircularController::class, 'getAllJobs']);
    Route::get('/recruiter/all-applicants', [JobSeekerManagementController::class, 'getAllApplicants']);
    Route::get('/recruiter/applicants/filter', [JobSeekerManagementController::class, 'filterApplicants'])->name('recruiter.filter.applicants');


    Route::get('/send-mail', [JobSeekerManagementController::class, 'sendIndividualEmailToJobSeeker']);
    Route::get('/send-mail-bulk', [JobSeekerManagementController::class, 'sendBulkEmailToJobSeekers']);
    
    // Temporary 
    Route::get('/create-job', [JobSeekerManagementController::class, 'createJob']);
    Route::get('/logout', [RecruiterAuthController::class, 'logout']);

    Route::get('/job-schedule',function(){
        return view('recruiter.sazzad.job-schedule');
    });

    //Sazzad vai front end
    Route::get('/demo',function(){
        return view('recruiter.sazzad.demo');
    });
});


Route::get('/js/apply-job/{job}', [JobApplicationController::class, 'applyJob']);

Route::post('/parse-cv', [JobApplicationController::class, 'storeCV']);
Route::get('/fetch-job-description', [JobCircularController::class, 'fetchJobDetailsByAI']);
Route::post('/fetch-job-details', [JobCircularController::class, 'fetchJobDetailsByAI']);











































































/*========= Admin routes=============
===================================*/
Route::middleware(['guest:admin'])->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::get('/admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
});

Route::middleware(['auth:admin'])->group(function () {
    // Admin dashboard or other authenticated routes
    Route::get('/admin/dashboard', [AdminAuthController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminAuthController::class, 'logout']);
});





/*========= JobSeeker routes=============
===================================*/
Route::middleware(['guest:job_seeker'])->group(function () {
    Route::get('/job_seeker/login', [JobSeekerAuthController::class, 'showLoginForm'])->name('job_seeker.login');
    Route::post('/job_seeker/login', [JobSeekerAuthController::class, 'login'])->name('job_seeker.login');
    Route::get('/job_seeker/register', [JobSeekerAuthController::class, 'showRegistrationForm'])->name('job_seeker.register');
    Route::post('/job_seeker/register', [JobSeekerAuthController::class, 'register'])->name('job_seeker.register');
});

Route::middleware(['auth:job_seeker'])->group(function () {
    // job_seeker dashboard or other authenticated routes
    Route::get('/job_seeker/dashboard', [JobSeekerAuthController::class, 'index'])->name('job_seeker.dashboard');
    Route::get('/job_seeker/logout', [JobSeekerAuthController::class, 'logout']);
});

//=====================================//
Route::get('/welcome', function () {
    return view('welcome');
});










