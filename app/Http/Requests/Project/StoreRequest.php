<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
