<?php

namespace App\Policies;

use App\Models\User;

class CongerationPolicy
{

    public function readPolicy(User $user): bool
    {
        return $user->can('employee-read');

    }

    public function createPolicy(User $user): bool
    {
        return $user->can('employee-create');

    }

    public function updatePolicy(User $user): bool
    {
        return $user->can('employee-update');

    }
    public function deletePolicy(User $user): bool
    {
        return $user->can('employee-delete');

    }
}
