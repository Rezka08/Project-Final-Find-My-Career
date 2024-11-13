<?php

namespace App\Http\Controllers;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        return view('employer.dashboard');
    }
}