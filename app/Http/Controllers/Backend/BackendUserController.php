<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendUserController extends Controller
{
    //

    /**
     * The User Model instance.
     */
    protected $user;

    /**
     * Assign Category Model in Controller
     *
     * @param  Category $categories
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display List of users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('backend.users.index', compact('users'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id')->all();
        return view('backend.users.create',compact('roles'));
    }


    /**
     *  Store a newly User in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {

        $input = $request->all();
        // Encrypt  password
        $input['password']=bcrypt($request->password);


        if (User::create($input)) {

            \Session::flash('flash_message_success', 'Success! Entry saved.');
        }else{
            \Session::flash('flash_message_error', 'Error! Entry Not saved.');
        }

        // Return to  user list page
       return redirect()->route('users.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $roles=Role::pluck('name','id')->all();

        return view('backend.users.edit', compact('user','roles'));
    }


    /**
     * Update user information
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {


        $user=User::findOrFail($id);


        //If password is empty, remove it from request
        if(trim($request->password=='')){
            $input=$request->except('password');
        }else{
           // If password is not empty , crypt it
            $input=$request->all();
            $input['password']=bcrypt($request->password);
        }



            if ($user->update($input)) {

                \Session::flash('flash_message_success', 'Success! Entry updated.');
            } else {
                \Session::flash('flash_message_error', 'Error! Entry Not updated.');
            }


            return redirect()->route('users.edit', $id);

    }




    /**
     * Show the form for editing the user's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $user=Auth::user();
        return view('backend.users.edit_profile', compact('user'));
    }





    /**
     * Update personal user profile
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UserProfileUpdateRequest $request, $id)
    {

        $user=User::findOrFail($id);

        //Remove these fields for security
        $input=$request->except('role_id','status');

        //If password is empty, remove it from request
        if(trim($request->password=='')){
            $input=$request->except('password');
        }else{
            // If password is not empty , crypt it
            $input=$request->all();
            $input['password']=bcrypt($request->password);
        }



        if ($user->update($input)) {

            \Session::flash('flash_message_success', 'Success! Entry updated.');
        } else {
            \Session::flash('flash_message_error', 'Error! Entry Not updated.');
        }


        return redirect()->route('user.profile');

    }







    /**
     * Show the form with options for delete Users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        //Check some point

        //1) Did the user selected has post?
        //If it has,  so I need to ask to user what they want to do with Posts (delete, Move)
        $has_posts = $user->posts()->count();

        // Get all Category tree except the category branch and its related sub category
        $all_users = User::where('id','<>',$id)->get();


        return view( 'backend.users.delete', compact('user','has_posts', 'all_users') );
    }




    /**
     * Remove the specified resource from storage.
     * We retrieve the Admin choose about how manage user and posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        //Recovery input data
        $input_data = $request->all();

        if(intval($input_data['delete_option'])>0){

            switch ($input_data['delete_option']){

                case 1 : $result = $this->user->deletePostAndUser($id);
                    break;

                case 2 :  $result = $this->user->movePostsToUser($id, $input_data['new_id_user']);

                    break;
            }

        }

        if($result){
            \Session::flash('flash_message_success', 'Success! User deleted.');
        }else{
            \Session::flash('flash_message_error', 'Error! User Not deleted.');
        }

        return redirect()->route('users.index');
    }





}
