<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageTranslationRequest extends FormRequest
{


    /**
     * Define validation rules
     *
     * @return array
     *
     */
    public function updateRules(): array
    {
        return [
            'title' => 'required',
            'featured_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
        return $this->updateRules();
    }
}
