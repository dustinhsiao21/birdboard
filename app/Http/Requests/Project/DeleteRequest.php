<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class DeleteRequest extends Request
{
    /**
     * authorize
     *
     * @return boolean
     */
    public function authorize()
    {
        return Gate::allows('delete', $this->route('project'));
    }
}
