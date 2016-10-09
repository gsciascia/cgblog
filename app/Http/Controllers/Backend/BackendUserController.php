<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendUserController extends Controller
{
    //

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

   //     if (Auth::user()->can('update', $post_obj)) {

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

/*        }else{
            abort(503);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     * We retrieve the user choose about how manage sub folder and posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        if($result){
            \Session::flash('flash_message_success', 'Success! Category deleted.');
        }else{
            \Session::flash('flash_message_error', 'Error! Category Not deleted.');
        }

        return redirect()->route('categories.index');
    }






}
