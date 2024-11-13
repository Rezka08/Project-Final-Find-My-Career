<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::where('employer_id', auth()->id())->paginate(10);
        return view('employer.jobs.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required',
            'description' => 'required',
            'salary_range' => 'required'
        ]);

        $validated['employer_id'] = auth()->id();
        JobPost::create($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job post created successfully');
    }

    public function edit(JobPost $jobPost)
    {
        $this->authorize('update', $jobPost);
        return view('employer.jobs.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $this->authorize('update', $jobPost);
        
        $validated = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required',
            'description' => 'required',
            'salary_range' => 'required'
        ]);

        $jobPost->update($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job post updated successfully');
    }

    public function destroy(JobPost $jobPost)
    {
        $this->authorize('delete', $jobPost);
        $jobPost->delete();
        return redirect()->route('employer.jobs.index')->with('success', 'Job post deleted successfully');
    }
}