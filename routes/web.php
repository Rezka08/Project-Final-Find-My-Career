<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\JobSeekerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobSeekerProfileController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Tambahkan public job listing route
Route::get('/browse-jobs', [JobPostController::class, 'publicIndex'])->name('jobs.browse');

// Routes yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('job-seeker.dashboard');
        }
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route khusus untuk masing-masing role
    Route::middleware(['auth'])->group(function() {
        // Employer Routes
        Route::get('/employer/dashboard', function() {
            if(auth()->user()->role === 'employer') {
                return view('employer.dashboard');
            }
            return redirect()->route('dashboard');
        })->name('employer.dashboard');

        // Job Routes (hanya untuk employer)
        Route::prefix('jobs')->group(function () {
            Route::get('/create', [JobPostController::class, 'create'])->name('jobs.create');
            Route::post('/', [JobPostController::class, 'store'])->name('jobs.store');
            Route::get('/', [JobPostController::class, 'index'])->name('jobs.index');
            Route::get('/{job}/edit', [JobPostController::class, 'edit'])->name('jobs.edit');
            Route::put('/{job}', [JobPostController::class, 'update'])->name('jobs.update');
            Route::delete('/{job}', [JobPostController::class, 'destroy'])->name('jobs.destroy');
            // Tambahkan route untuk lihat aplikasi per job
            Route::get('/{job}/applications', [JobPostController::class, 'showApplications'])
                ->name('jobs.applications');
        });

        // Job Seeker Routes
        Route::prefix('job-seeker')->group(function () {
            Route::get('/dashboard', function() {
                if(auth()->user()->role === 'job_seeker') {
                    return view('job-seeker.dashboard');
                }
                return redirect()->route('dashboard');
            })->name('job-seeker.dashboard');

            // Job Application Routes
            Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'apply'])
                ->name('jobs.apply');
            Route::get('/my-applications', [JobApplicationController::class, 'myApplications'])
                ->name('job-seeker.applications');
            // Dalam group middleware auth
            Route::get('/jobs/search', [JobPostController::class, 'search'])->name('jobs.search');

            Route::get('/job-seeker/profile', [JobSeekerProfileController::class, 'show'])
                ->name('job-seeker.profile');
            Route::get('/job-seeker/profile/edit', [JobSeekerProfileController::class, 'edit'])
                ->name('job-seeker.profile.edit');
            Route::put('/job-seeker/profile', [JobSeekerProfileController::class, 'update'])
                ->name('job-seeker.profile.update');
        });

        // Admin Routes
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', function() {
                if(auth()->user()->role === 'admin') {
                    return view('admin.dashboard');
                }
                return redirect()->route('dashboard');
            })->name('admin.dashboard');

            // Admin management routes
            Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
            Route::get('/jobs', [AdminDashboardController::class, 'jobs'])->name('admin.jobs');
            Route::get('/applications', [AdminDashboardController::class, 'applications'])
                ->name('admin.applications');
        });

        // Shared Routes (accessible by all authenticated users)
        Route::get('/jobs/{job}', [JobPostController::class, 'show'])->name('jobs.show');
    });
});

// Handle Job Application Status Updates
Route::middleware(['auth'])->group(function () {
    Route::patch('/applications/{application}/status', [JobApplicationController::class, 'updateStatus'])
        ->name('applications.update-status');
});

require __DIR__.'/auth.php';