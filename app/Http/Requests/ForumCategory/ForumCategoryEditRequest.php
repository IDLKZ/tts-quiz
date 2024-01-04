<?php

namespace App\Http\Requests\ForumCategory;

use Illuminate\Foundation\Http\FormRequest;

class ForumCategoryEditRequest extends FormRequest
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
            "image_url"=>"sometimes|nullable|image|max:100000"
        ];
    }
}
