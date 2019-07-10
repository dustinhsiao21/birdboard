<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'tasks' => 'array',
        ];
    }
}
