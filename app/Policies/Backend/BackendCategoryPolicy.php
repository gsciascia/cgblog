<?php

namespace App\Policies\Backend;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackendCategoryPolicy
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


    public function before($user)
    {
        if ($user->hasRole('admin') ) {
            return true;
        }


    }

}
