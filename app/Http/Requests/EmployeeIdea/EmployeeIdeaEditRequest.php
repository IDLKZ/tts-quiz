<?php

namespace App\Http\Requests\EmployeeIdea;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeIdeaEditRequest extends FormRequest
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
            "description"=>"required|max:100000",
            "image_url"=>"sometimes|nullable|image|max:100000",
            "file_url"=>"sometimes|nullable|file|max:100000",
            "keywords"=>"required",
        ];
    }
}
