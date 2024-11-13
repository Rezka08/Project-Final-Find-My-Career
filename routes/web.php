<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\JobSeekerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        switch($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'employer':
                return redirect()->route('employer.dashboard');
            default:
                return redirect()->route('job-seeker.dashboard');
        }
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job Seeker Routes
    Route::get('/job-seeker/dashboard', [JobSeekerDashboardController::class, 'index'])
        ->name('job-seeker.dashboard');

    // Employer Routes
    Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])
        ->name('employer.dashboard');

    // Admin Routes
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

require __DIR__.'/auth.php';