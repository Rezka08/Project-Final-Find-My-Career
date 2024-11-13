<?php

namespace App\Policies;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, JobPost $jobPost)
    {
        return $user->id === $jobPost->employer_id;
    }

    public function delete(User $user, JobPost $jobPost)
    {
        return $user->id === $jobPost->employer_id;
    }
}