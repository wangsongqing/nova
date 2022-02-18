<?php


namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class RolesPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, $value)
    {
        if (isset($value->id) && $value->id == 1) {
            return false;
        }
        return true;
    }
}
