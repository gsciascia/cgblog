<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route('profile');


        if(Auth::user()->id!=$user_id){
         return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $user_id = $this->route('profile');

        return [
            'name'=>'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user_id,
            'password'=>'sometimes|AlphaNum|Between:5,10',
        ];
    }
}
