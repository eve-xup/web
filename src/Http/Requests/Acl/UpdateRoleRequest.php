<?php

namespace Xup\Web\Http\Requests\Acl;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{

    public function rules(){
        return [
            'role.title' => 'required',
            'role.description' => 'string|nullable',
            'permissions'   => 'array|nullable',
            'users'         => 'array|nullable',
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