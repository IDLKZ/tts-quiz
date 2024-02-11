<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionnaireEditRequest extends FormRequest
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
            "departments"=>"required",
            "departments.*"=>"required|exists:departments,id",
            "start_at"=>"required",
            "end_at"=>"required",
        ];
    }
}
