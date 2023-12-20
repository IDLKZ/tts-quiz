<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
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
            "subtitle"=>"required|max:255",
            "description"=>"required|max:50000",
            "image_url"=>"required|file|image|max:20420",
            "companies"=>"sometimes|nullable|array",
            "companies.*"=>"exists:companies,id",
            "departments"=>"sometimes|nullable|array",
            "departments.*"=>"exists:departments,id",
        ];
    }
}
