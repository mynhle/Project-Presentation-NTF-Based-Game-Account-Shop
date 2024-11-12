<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Đảm bảo cho phép người dùng gửi request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'is_active' => 'required|boolean',
            'image' => 'required|image|max:2048',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên game là bắt buộc.',
            'name.min' => 'Tên game phải có ít nhất 3 ký tự.',
            'is_active.required' => 'Trạng thái game là bắt buộc.',
            'image.required' => 'Hình ảnh game là bắt buộc.',
            'image.image' => 'Hình ảnh phải là một tệp ảnh.',
        ];
    }
}
