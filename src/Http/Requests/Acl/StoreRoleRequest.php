<?php

namespace Xup\Web\Http\Requests\Acl;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{


    public function rules(){
        return [
            'role.title'=> 'required|unique:roles,title',
            'role.description' => 'nullable|max:255'
        ];
    }


    public function messages(){
        return [
            'role.title.required' => "Role Title is required",
            'role.title.unique' => "Role Title must be unique",
            'role.description.max' => "Jesus that a novel!",
        ];
    }
}