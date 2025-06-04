<?php

namespace App\Policies;

use App\Models\User;

class MosquePolicy
{

    public function readPolicy(User $user): bool
    {
        return $user->can('company-read');
    }

    public function createPolicy(User $user): bool
    {
        return $user->can('company-create');
    }

    public function updatePolicy(User $user): bool
    {
        return $user->can('company-update');
    }
    public function deletePolicy(User $user): bool
    {
        return $user->can('company-delete');
    }
}
