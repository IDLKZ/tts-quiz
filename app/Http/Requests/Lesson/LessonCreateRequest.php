<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonCreateRequest extends FormRequest
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
            "course_id"=>"required|exists:courses,id",
            "type"=>"required|max:255",
            "video_url"=>"required|max:5000",
            "image_url"=>"required|image|max:20480",
            "video"=>"sometimes|nullable|file|mimetypes:video/avi,video/mpeg,video/quicktime|max:1024000",
            "title"=>"required|max:255",
            "subtitle"=>"required|max:255",
            "description"=>"required|max:50000",
            "order"=>"required|integer|min:0|max:1000",
            "prev_id"=>"sometimes|nullable|exists:lessons,id",
            "next_id"=>"sometimes|nullable|exists:lessons,id",
        ];
    }
}
