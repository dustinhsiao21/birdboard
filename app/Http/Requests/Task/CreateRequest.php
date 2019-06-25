<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

class CreateRequest extends Request
{
    public function rules()
    {
        return [
            'body' => 'required|string',
        ];
    }
}
