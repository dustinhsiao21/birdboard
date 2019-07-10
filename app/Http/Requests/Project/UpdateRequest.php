<?php

namespace App\Http\Requests\Project;

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
        return Gate::allows('update', $this->route('project'));
    }

    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'notes' => 'string',
        ];
    }
}
