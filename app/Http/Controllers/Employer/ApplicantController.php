<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(JobPost $jobPost)
    {
        $this->authorize('viewApplicants', $jobPost);
        
        $applications = $jobPost->applications()->paginate(10);
        return view('employer.applicants.index', compact('jobPost', 'applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('updateStatus', $application);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application status updated successfully');
    }
}
