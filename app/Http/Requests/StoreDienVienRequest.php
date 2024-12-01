<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDienVienRequest extends FormRequest
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
            'ten_dien_vien' => 'required|string|max:255|unique:dien_viens,ten_dien_vien',
            'anh_dien_vien' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nam_sinh' => 'required|date',
            'quoc_tich' => 'required|string|max:255',
            'gioi_tinh' => 'required|string',
            'tieu_su' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [

            'ten_dien_vien.unique' => ' tên diễn viên đã tồn tại',
            'ten_dien_vien.required' => 'Bắt buộc nhập Tên diễn viên .',
            'ten_dien_vien.string' => 'Tên diễn viên phải là một chuỗi.',
            'ten_dien_vien.max' => 'Tên diễn viên không được vượt quá 255 ký tự.',
            'anh_dien_vien.required' => 'Bắt buộc nhập Ảnh diễn viên .',
            'anh_dien_vien.image' => 'Tập tin phải là một hình ảnh.',
            'anh_dien_vien.mimes' => 'Ảnh diễn viên phải có định dạng: jpeg, png, jpg, gif.',
            'anh_dien_vien.max' => 'Ảnh diễn viên không được vượt quá 2MB.',
            'nam_sinh.required' => 'Bắt buộc nhập Năm sinh .',
            'nam_sinh.date' => 'Năm sinh không hợp lệ.',
            'quoc_tich.required' => 'Bắt buộc nhập Quốc tịch .',
            'quoc_tich.string' => 'Quốc tịch phải là một chuỗi.',
            'quoc_tich.max' => 'Quốc tịch không được vượt quá 255 ký tự.',
            'gioi_tinh.required' => 'Bắt buộc nhập Giới tính .',
            'gioi_tinh.string' => 'Giới tính phải là một chuỗi.',
            'tieu_su.string' => 'Tiểu sử phải là một chuỗi.',
        ];
    }
}
