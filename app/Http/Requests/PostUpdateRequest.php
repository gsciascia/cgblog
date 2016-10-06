<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostUpdateRequest extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'abstract' => 'required',
            'content' => 'string',
            'publish_date' => 'sometimes|required',
            'status' => 'required|in:publish,draft,delete',

        ];
    }
}
