<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = auth()->user()->profile;
        return view('jobseeker.profile.show', compact('profile'));
    }

    public function create()
    {
        return view('jobseeker.profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'age' => 'required|numeric|min:15|max:100',
            'gender' => 'required|in:male,female,other',
            'short_description' => 'required',
            'skills' => 'required'
        ]);

        $validated['user_id'] = auth()->id();
        Profile::create($validated);

        return redirect()->route('jobseeker.profile.show')->with('success', 'Profile created successfully');
    }

    public function edit()
    {
        $profile = auth()->user()->profile;
        return view('jobseeker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'age' => 'required|numeric|min:15|max:100',
            'gender' => 'required|in:male,female,other',
            'short_description' => 'required',
            'skills' => 'required'
        ]);

        auth()->user()->profile->update($validated);

        return redirect()->route('jobseeker.profile.show')->with('success', 'Profile updated successfully');
    }
}
