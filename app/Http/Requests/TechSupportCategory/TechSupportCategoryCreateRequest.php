<?php

namespace App\Http\Requests\TechSupportCategory;

use Illuminate\Foundation\Http\FormRequest;

class TechSupportCategoryCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"=>"required|max:255"
        ];
    }
}
