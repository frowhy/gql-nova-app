<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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

    public function viewAny(User $user)
    {
        return Gate::any(['viewPosts', 'managePosts'], $user);
    }

    public function view(User $user, Post $post)
    {
        return Gate::any(['viewPosts', 'managePosts'], $user, $post);
    }

    public function create(User $user)
    {
        return $user->can('managePosts');
    }

    public function update(User $user, Post $post)
    {
        return $user->can('managePosts', $post);
    }

    public function deleteUser(User $user, Post $post)
    {
        return $user->can('managePosts', $post);
    }

    public function restore(User $user, Post $post)
    {
        return $user->can('managePosts', $post);
    }

    public function forceDelete(User $user, Post $post)
    {
        return $user->can('managePosts', $post);
    }
}
