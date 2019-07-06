<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class InviteRequest extends Request
{
    public function authorize()
    {
        return Gate::allows('invite', $this->route('project'));
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
        ];
    }
}
