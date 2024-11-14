<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
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

    public function edit(JobPost $job)
    {
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gt:salary_min',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(JobPost $job)
    {
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }
        
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    public function publicIndex()
    {
        $jobs = JobPost::where('is_active', true)->latest()->paginate(10);
        return view('jobs.public', compact('jobs'));
    }

    public function show(JobPost $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function search(Request $request)
    {
        $query = JobPost::query()->where('is_active', true);

        // Search by title or description
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by type
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by salary range
        if ($request->has('salary_min')) {
            $query->where('salary_max', '>=', $request->salary_min);
        }

        // Sort
        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'salary_high':
                $query->orderBy('salary_max', 'desc');
                break;
            case 'salary_low':
                $query->orderBy('salary_min', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $jobs = $query->paginate(10)->withQueryString();

        return view('jobs.search', compact('jobs'));
    }
}