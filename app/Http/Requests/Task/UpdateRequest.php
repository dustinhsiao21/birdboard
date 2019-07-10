<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends Request
{
    /**
     * authorize
     *
     * @return boolean
     */
    public function authorize()
    {
        return Gate::allows('updateTask', $this->route('project'));
    }

    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|string',
            'completed' => 'string',
        ];
    }
}
