<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
            'title'         =>'min:1|max:300|required|unique:articles',
            'content'       =>'min:1|required',
            'category_id'   =>'required',
            'img'           =>'image|max:4000'
        ];
    }
}
