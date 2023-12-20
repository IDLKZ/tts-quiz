<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionEditRequest extends FormRequest
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
            "lesson_id"=>"required|exists:lessons,id",
            "text"=>"required|max:255",
            "context"=>"required|max:20000",
            "a"=>"required|max:20000",
            "b"=>"required|max:20000",
            "c"=>"required|max:20000",
            "d"=>"sometimes|nullable|max:20000",
            "e"=>"sometimes|nullable|max:20000",
            "f"=>"sometimes|nullable|max:20000",
            "g"=>"sometimes|nullable|max:20000",
            "h"=>"sometimes|nullable|max:20000",
            "correct_answer"=>"required",
        ];
    }
}
