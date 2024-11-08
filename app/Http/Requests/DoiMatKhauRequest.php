<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoiMatKhauRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mat_khau_cu' => 'required',
            'mat_khau_moi' => 'required|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'mat_khau_cu.required' => 'Vui lòng nhập mật khẩu cũ.',
            'mat_khau_moi.required' => 'Vui lòng nhập mật khẩu mới.',
            'mat_khau_moi.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'mat_khau_moi.confirmed' => 'Xác minh mật khẩu mới không khớp.'
        ];
    }
}
