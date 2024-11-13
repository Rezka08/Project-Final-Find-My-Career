<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Employer\ApplicantController;
use App\Http\Controllers\JobSeeker\ProfileController as JobSeekerProfileController;
use App\Http\Controllers\JobSeeker\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [JobPostController::class, 'index'])->name('home');
Route::get('/jobs/{jobPost}', [JobPostController::class, 'show'])->name('jobs.show');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserManagementController::class);
    });

    // Employer Routes
    Route::middleware(['employer'])->prefix('employer')->name('employer.')->group(function () {
        Route::resource('jobs', JobPostController::class);
        Route::get('jobs/{jobPost}/applicants', [ApplicantController::class, 'index'])->name('jobs.applicants');
        Route::patch('applications/{application}/status', [ApplicantController::class, 'updateStatus'])->name('applications.status');
    });

    // Job Seeker Routes
    Route::middleware(['jobseeker'])->prefix('jobseeker')->name('jobseeker.')->group(function () {
        Route::get('profile', [JobSeekerProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/create', [JobSeekerProfileController::class, 'create'])->name('profile.create');
        Route::post('profile', [JobSeekerProfileController::class, 'store'])->name('profile.store');
        Route::get('profile/edit', [JobSeekerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [JobSeekerProfileController::class, 'update'])->name('profile.update');
        
        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::post('jobs/{jobPost}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    });

    // Rating Routes
    Route::post('ratings', [RatingController::class, 'store'])->name('ratings.store')->middleware('jobseeker');
});

// Authentication Routes
require __DIR__.'/auth.php';