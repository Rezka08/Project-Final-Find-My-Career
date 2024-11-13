<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;

class JobSeekerProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->jobSeekerProfile;
        return view('seeker-profile.index', compact('profile'));
    }

    public function create()
    {
        return view('seeker-profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:255',
            'age' => 'required|integer|min:17',
            'gender' => 'required|in:male,female',
            'description' => 'required|string',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $validated['user_id'] = auth()->id();
        
        JobSeekerProfile::create($validated);

        return redirect()->route('seeker-profile.index')
            ->with('success', 'Profile created successfully');
    }

    public function show(JobSeekerProfile $seekerProfile)
    {
        return view('seeker-profile.show', compact('seekerProfile'));
    }

    public function edit(JobSeekerProfile $seekerProfile)
    {
        return view('seeker-profile.edit', compact('seekerProfile'));
    }

    public function update(Request $request, JobSeekerProfile $seekerProfile)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:255',
            'age' => 'required|integer|min:17',
            'gender' => 'required|in:male,female',
            'description' => 'required|string',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $seekerProfile->update($validated);

        return redirect()->route('seeker-profile.index')
            ->with('success', 'Profile updated successfully');
    }

    public function destroy(JobSeekerProfile $seekerProfile)
    {
        $seekerProfile->delete();

        return redirect()->route('seeker-profile.index')
            ->with('success', 'Profile deleted successfully');
    }
}