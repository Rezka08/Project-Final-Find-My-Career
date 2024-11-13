<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminLog;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:employer,job_seeker'
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'activity' => "Created new user: {$user->username}",
            'logged_at' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:employer,job_seeker'
        ]);

        $user->update($validated);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'activity' => "Updated user: {$user->username}",
            'logged_at' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        AdminLog::create([
            'admin_id' => auth()->id(),
            'activity' => "Deleted user: {$user->username}",
            'logged_at' => now()
        ]);

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}