<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required'
        ]);

        $validated['job_seeker_id'] = auth()->id();
        Rating::create($validated);

        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
}