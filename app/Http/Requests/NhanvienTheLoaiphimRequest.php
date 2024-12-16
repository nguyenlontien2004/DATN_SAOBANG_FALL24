<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanvienTheLoaiphimRequest extends FormRequest
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
    public function rules()
    {
        return [
            'ten_the_loai' => 'required|string|max:255|unique:the_loai_phims,ten_the_loai,' . $this->route('nhanvientheLoaiPhim')->id,
        ];
    }

    public function messages()
    {
        return [
            'ten_the_loai.unique'=>'tên thể loại này đã tồn tại',
            'ten_the_loai.required' => 'Bắt buộc nhập Tên thể loại .',
            'ten_the_loai.string' => 'Tên thể loại phải là một chuỗi.',
            'ten_the_loai.max' => 'Tên thể loại không được vượt quá 255 ký tự.',
        ];
    }
}
