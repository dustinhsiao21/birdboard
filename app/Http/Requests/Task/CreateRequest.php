<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class CreateRequest extends Request
{
    public function authorize()
    {
        return Gate::allows('createTask', $this->route('project'));
    }

    public function rules()
    {
        return [
            'body' => 'required|string',
        ];
    }
}
