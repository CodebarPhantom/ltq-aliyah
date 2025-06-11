<?php

namespace App\Policies;

use App\Models\User;

class MosquePolicy
{

    public function readPolicy(User $user): bool
    {
        return $user->can('mosque-read');
    }

    public function createPolicy(User $user): bool
    {
        return $user->can('mosque-create');
    }

    public function updatePolicy(User $user): bool
    {
        return $user->can('mosque-update');
    }
    public function deletePolicy(User $user): bool
    {
        return $user->can('mosque-delete');
    }
}
