<?php
namespace WhatsappChatbot\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddChildToAnswerRequest extends FormRequest
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
            'key'               => 'nullable',
            'input'             => 'required',
            'texts'             => 'required|array',
            'method'            => 'nullable|string',
        ];
    }
}
