<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Slug;

class SlugsRequest extends FormRequest
{
    /**
     * Define validation rules
     *
     * @return array
     *
     */
    public function createRules(): array
    {
        $rules = [];
        $languages = config('languages');

        foreach ($languages as $language) {
            $code = $language['code'];

            $rules["slugs.$code"] = [
                'sometimes',
                function ($attribute, $value, $fail) use ($code) {
                    if (Slug::where('slug', $value)->where('language', $code)->exists()) {
                        $fail(trans("admin/components.fails.slug_taken", ['language' => $code]));
                    }
                },
            ];
        }

        return $rules;
    }

    /**
     * Define validation rules
     *
     * @return array
     *
     */
    public function updateRules(): array
    {

        $rules = [];
        $languages = config('languages');

        $content_id = Slug::findorfail($this->id)->content_id; // Mevcut slug'ın content_id'sini alıyoruz

        foreach ($languages as $language) {
            $code = $language['code'];

            $rules["slugs.$code"] = [
                'sometimes',
                function ($attribute, $value, $fail) use ($code, $content_id) {
                    if (Slug::where('slug', $value)
                        ->where('language', $code)
                        ->where('content_id', '!=', $content_id)
                        ->exists()) {
                        $fail(trans("admin/components.fails.slug_taken", ['language' => $code]));
                    }
                },
            ];
        }

        return $rules;


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
