<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name'      => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'password'  => 'min:5|max:16',
            'email'     => 'unique:users,email,'.Auth::user()->id,
            'fecha'     => 'required|date|date_format:Y-m-d|before:today',
        ];
    }
}
