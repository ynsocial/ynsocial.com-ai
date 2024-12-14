<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required|unique:slugs,slug',
            'featured_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
            'title' => 'required',
            'slug' => Rule::unique('slugs', 'slug')->where(function ($query) {
                return $query->where(DB::raw("CONCAT(alias, content_id)"), '!=', "pages" . $this->id);
            }),
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } else if ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
}
