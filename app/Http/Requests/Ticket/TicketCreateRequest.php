<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            "category_id"=>"required|exists:ticket_categories,id",
            "title"=>"required|max:255",
            "description"=>"required|max:50000",
            "file_url"=>"sometimes|nullable|file|max:50000",
        ];
    }
}
