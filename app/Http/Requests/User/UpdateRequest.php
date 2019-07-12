<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'password' => 'string|min:8|confirmed|nullable',
        ];
    }
}
