<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * authorize.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * take the values only when the keys in rules().
     *
     * @return array
     */
    public function onlyRules()
    {
        $fields = array_keys($this->rules());
        $fields = array_map(function ($field) {
            return strstr($field, '.*', true) ?: $field;
        }, $fields);

        return $this->only($fields);
    }

    /**
     * the rules of each request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * if the authorize() is failure, will abort to 403.
     *
     * @return view
     */
    public function forbiddenResponse()
    {
        abort(403);
    }
}
