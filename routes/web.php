<?php
use Illuminate\Support\Facades\Route;

// Auth::routes();

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Recruiter\RecruiterAuthController;
use App\Http\Controllers\JobSeeker\JobSeekerAuthController;

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


/*========= Recruiter routes=============
===================================*/
Route::middleware(['guest:recruiter'])->group(function () {
    Route::get('/', [RecruiterAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [RecruiterAuthController::class, 'login'])->name('recruiter.login');
    Route::get('/recruiter/register', [RecruiterAuthController::class, 'showRegistrationForm'])->name('recruiter.register');
    Route::post('/recruiter/register', [RecruiterAuthController::class, 'register'])->name('recruiter.register');
});

Route::middleware(['auth:recruiter'])->group(function () {
    // Recruiter dashboard or other authenticated routes
    Route::get('/recruiter/dashboard', [RecruiterAuthController::class, 'index'])->name('recruiter.dashboard');
    Route::get('/logout', [RecruiterAuthController::class, 'logout']);
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







