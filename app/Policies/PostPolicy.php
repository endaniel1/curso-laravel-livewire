<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function author(User $user, Post $post)
    {
        $roles = $user->roles; //get roles
        $admin = in_array('Admin', $roles->pluck('name')->toArray()); //check admin

        if ($user->id == $post->user_id || $admin) {
            return true;
        }else{
            return false;
        }
    }

    public function published(?User $user, Post $post)
    {
        if ($post->status == 2) {
            return true;
        }else{
            return false;
        }
    }
}
