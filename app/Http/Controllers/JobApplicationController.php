<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobPost $job)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan CV
        $path = $request->file('cv')->store('cvs', 'public');

        // Buat aplikasi
        JobApplication::create([
            'job_post_id' => $job->id,
            'user_id' => auth()->id(),
            'cv_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        $applications = JobApplication::where('user_id', auth()->id())
            ->with('jobPost')
            ->latest()
            ->paginate(10);

        return view('applications.my-applications', compact('applications'));
    }

    // Untuk Employer
    public function index(JobPost $job)
    {
        $this->authorize('view-applications', $job);

        $applications = JobApplication::where('job_post_id', $job->id)
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications', 'job'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        // Verify if the logged in user is the employer of this job
        if ($application->jobPost->employer_id !== auth()->id()) {
            abort(403);
        }

        $this->authorize('update-application', $application->jobPost);

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
            'note' => 'nullable|string|max:255'
        ]);

        $application->update([
            'status' => $request->status,
            'note' => $request->note
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
}