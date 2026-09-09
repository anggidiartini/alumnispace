<?php

namespace App\Policies;

use App\Models\AlumniProfile;
use App\Models\User;

class AlumniProfilePolicy
{
    public function update(User $user, AlumniProfile $alumniProfile): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $alumniProfile->user_id;
    }
}
