<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    public function updateStatus(User $user, Application $application)
    {
        return $user->id === $application->jobPost->employer_id;
    }
}