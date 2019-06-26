<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function onlyRules()
    {
        $fields = array_keys($this->rules());
        $fields = array_map(function ($field) {
            return strstr($field, '.*', true) ?: $field;
        }, $fields);

        return $this->only($fields);
    }

    public function rules()
    {
        return [];
    }
}
