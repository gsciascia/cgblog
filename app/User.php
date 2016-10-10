<?php

namespace App;

use App\Post;
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
        'name', 'last_name', 'email', 'password', 'is_active', 'role_id'
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






    /**
     * Delete the give category id  and all his sub-category and relative posts
     *
     * @param $id - The category id to delete
     * @return bool
     */
    public function deletePostAndUser($id)
    {
        $user_posts = $this->find($id)->posts()->get()->toArray();


        if(count($user_posts)>0) {
            foreach ($user_posts as $post) {


                Post::find($post['id'])->delete();

                // Delete entry in pivot
                if( !\DB::table('category_post')->where('post_id', '=', $post['id'])->delete() ){
                    return false;
                }



            }
        }


        if ($this->whereId($id)->delete()) {
            return true;
        }
        return false;
    }


    /**
     * Move post to another user
     *
     * @param $user_id
     * @param $new_user_id
     * @return bool
     *
     */
    public function movePostsToUser($user_id, $new_user_id)
    {


        if( \DB::table('posts')->where('user_id', '=', $user_id)->update(['user_id' => $new_user_id]) ){
            return true;
        }
        return false;
    }



}
