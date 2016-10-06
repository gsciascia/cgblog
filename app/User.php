<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * Create the 'role' relationship between User and Role models. 1 - 1
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role(){
        return $this->belongsTo('App\Role');
    }


    /**
     * Create the 'posts' relationship between User and Post models. 1 - N
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function posts(){
        return $this->hasMany('App\Post');
    }



    /**
     * Check if the user has the role passed as parameter and it is active
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role){

        // Change $role to Array. So we can have ['admin','author'])
        $A_role = explode('|',$role);

        if( is_array($A_role) ) {
            if ( in_array( $this->role->name, $A_role ) && $this->is_active == 1 ) {
                return true;
            }
        }

        return false;
    }




}
