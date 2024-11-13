<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function public(Request $request)
    {
        $query = JobPost::query()->where('is_active', true);
        
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->has('salary_min')) {
            $query->where('salary_min', '>=', $request->salary_min);
        }
        
        $jobs = $query->latest()->paginate(10);
        
        return view('jobs.public', compact('jobs'));
    }

    public function index()
    {
        $jobs = JobPost::where('employer_id', auth()->id())->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gt:salary_min',
        ]);

        $validated['employer_id'] = auth()->id();
        
        JobPost::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    public function show(JobPost $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(JobPost $job)
    {
        $this->authorize('update', $job);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gt:salary_min',
            'is_active' => 'boolean'
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(JobPost $job)
    {
        $this->authorize('delete', $job);
        
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}