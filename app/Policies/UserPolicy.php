<?php


namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 检查用户是否能够更新帖子模型
     *
     * @param User $user
     * @param $value
     * @return mixed
     */
    public function update(User $user, $value)
    {
        if ($user->id != 1) {
            return false;
        }

        if (isset($value->id) && $value->id == 1) {
            return false;
        }
        return true;
    }

    public function view(User $user)
    {
        return true;
    }

    public function delete(User $user, $value)
    {
        if ($user->id != 1) {
            return false;
        }

        if (isset($value->id) && $value->id == 1) {
            return false;
        }
        return true;
    }
}
