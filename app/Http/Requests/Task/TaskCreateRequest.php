<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            "task"=>"required|max:500",
            "details"=>"required|max:50000",
            "department_id"=>"required|exists:departments,id",
            "users"=>"required",
            "importance"=>"required|numeric|between:-1,2",
            "status"=>"required|numeric|between:-1,2",
            "start_date"=>"required",
            "end_date"=>"required",
        ];
    }
}
