<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoneRequest extends FormRequest
{
    /**
     * Define validation rules
     *
     * @return array
     *
     */
    public function createRules(): array
    {
        return [
            'source' => 'required|unique:gones,source'
        ];
    }

    /**
     * Define validation rules
     *
     * @return array
     *
     */
    public function updateRules(): array
    {

        return [
            'source' => 'required|unique:gones,source,'. $this->route('id')
        ];
    }

    /**
     * Apply rules
     *
     * @return array
     *
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } else if ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
}
