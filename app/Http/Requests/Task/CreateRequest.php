<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class CreateRequest extends Request
{
    /**
     * authorize.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('createTask', $this->route('project'));
    }

    /**
     * rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|string',
        ];
    }
}
