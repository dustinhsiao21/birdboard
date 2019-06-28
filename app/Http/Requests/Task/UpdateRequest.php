<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends Request
{
    public function authorize()
    {
        return Gate::allows('updateTask', $this->route('project'));
    }

    public function rules()
    {
        return [
            'body' => 'required|string',
            'completed' => 'string',
        ];
    }
}
