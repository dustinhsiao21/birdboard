<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'body' => 'required|string',
            'completed' => 'string',
        ];
    }
}
