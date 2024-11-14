<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        // Cek jika user bukan employer
        if (auth()->user()->role !== 'employer') {
            return redirect()->route('dashboard');
        }
        
        return view('employer.dashboard');
    }
}