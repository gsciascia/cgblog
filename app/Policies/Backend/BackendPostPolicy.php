<?php

namespace App\Policies\Backend;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BackendPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //


    }

    /**
     * Determine whether the user can create posts.
     * (It is associated with create() and Store() method controller)
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     * (It is associated with edit() and update() method controller)
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
        return ( $user->id == $post->user_id || Auth::user()->hasRole('admin') );
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
        return ( $user->id == $post->user_id || Auth::user()->hasRole('admin') );
    }




    /**
     * Determine whether the user can delete the post.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function manageTrashed(User $user, Post $post)
    {
       return ( $user->id == $post->deleted_by || Auth::user()->hasRole('admin') );
    }

}
