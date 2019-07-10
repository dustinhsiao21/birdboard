<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class InviteRequest extends Request
{
    /**
     * authorize.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('invite', $this->route('project'));
    }

    /**
     * rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
        ];
    }
}
