<?php

namespace App\Http\Requests\Literature;

use Illuminate\Foundation\Http\FormRequest;

class LiteratureEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            "title"=>"required|max:255",
            "description"=>"required|max:50000",
            "category_id"=>"required|exists:literature_categories,id",
            "image_url"=>"sometimes|nullable|image|max:20524"
        ];
    }
}
