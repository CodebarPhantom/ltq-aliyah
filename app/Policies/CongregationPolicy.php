<?php

namespace App\Policies;

use App\Models\User;

class CongregationPolicy
{

    public function readPolicy(User $user): bool
    {
        return $user->can('congregation-read');

    }

    public function createPolicy(User $user): bool
    {
        return $user->can('congregation-create');

    }

    public function updatePolicy(User $user): bool
    {
        return $user->can('congregation-update');

    }
    public function deletePolicy(User $user): bool
    {
        return $user->can('congregation-delete');

    }
}
