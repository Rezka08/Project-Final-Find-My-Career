<?php

namespace App\Policies;

use App\Models\JobPost;
use App\Models\User;

class JobPostPolicy
{
    public function update(User $user, JobPost $jobPost)
    {
        return $user->id === $jobPost->employer_id;
    }

    public function delete(User $user, JobPost $jobPost)
    {
        return $user->id === $jobPost->employer_id;
    }

    public function viewApplicants(User $user, JobPost $jobPost)
    {
        return $user->id === $jobPost->employer_id;
    }
}