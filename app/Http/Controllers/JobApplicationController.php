<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function apply(Request $request, JobPost $job)
{
    $request->validate([
        'cv' => 'required|mimes:pdf|max:2048'
    ]);

    $path = $request->file('cv')->store('cvs', 'public');

    JobApplication::create([
        'job_post_id' => $job->id,
        'job_seeker_id' => auth()->id(),
        'cv_path' => $path,
        'status' => 'pending'
    ]);

    return redirect()->back()->with('success', 'Application submitted successfully!');
}
}
