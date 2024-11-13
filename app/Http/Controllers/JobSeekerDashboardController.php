<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSeekerDashboardController extends Controller
{
    public function index()
    {
        // Cek role
        if (auth()->user()->role !== 'job_seeker') {
            abort(403, 'Unauthorized action.');
        }
        
        return view('job-seeker.dashboard');
    }
}