<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('job_seeker_id', auth()->id())->paginate(10);
        return view('jobseeker.applications.index', compact('applications'));
    }

    public function store(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate([
            'cv_attachment' => 'required|mimes:pdf|max:2048'
        ]);

        $cvPath = $request->file('cv_attachment')->store('cv_attachments', 'public');

        Application::create([
            'job_post_id' => $jobPost->id,
            'job_seeker_id' => auth()->id(),
            'cv_attachment' => $cvPath,
            'status' => 'pending',
            'applied_at' => now()
        ]);

        return redirect()->route('jobseeker.applications.index')->with('success', 'Application submitted successfully');
    }
}
