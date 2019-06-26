<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'notes' => 'string',
        ];
    }
}
