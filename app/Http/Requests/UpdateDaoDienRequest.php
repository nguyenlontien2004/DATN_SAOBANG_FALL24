<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDaoDienRequest extends FormRequest
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
            'ten_dao_dien' => 'required|string|max:255|unique:dao_diens,ten_dao_dien,' . $this->route('daoDien')->id,
            'anh_dao_dien' => 'image|mimes:jpeg,png,jpg,gif',
            'nam_sinh' => 'required|date',
            'quoc_tich' => 'required|string|max:255',
            'gioi_tinh' => 'required|string',
            'trang_thai' => 'required|boolean',
            'tieu_su' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'ten_dao_dien.required' => 'Bắt buộc nhập Tên đạo diễn .',
            'ten_dao_dien.unique'=>'tên đạo diễn đã tồn tại',
            'ten_dao_dien.string' => 'Tên đạo diễn phải là một chuỗi.',
            'ten_dao_dien.max' => 'Tên đạo diễn không được vượt quá 255 ký tự.',
           
            'anh_dao_dien.mimes' => 'Ảnh đạo diễn phải có định dạng: jpeg, png, jpg, gif.',
            'anh_dao_dien.max' => 'Ảnh đạo diễn không được vượt quá 2MB.',

            'nam_sinh.required' => 'Bắt buộc nhập Năm sinh .',
            'nam_sinh.date' => 'Năm sinh không hợp lệ.',

            'quoc_tich.required' => 'Bắt buộc nhập Quốc tịch .',
            'quoc_tich.string' => 'Quốc tịch phải là một chuỗi.',
            'quoc_tich.max' => 'Quốc tịch không được vượt quá 255 ký tự.',

            'gioi_tinh.required' => 'Bắt buộc nhập Giới tính .',
            'gioi_tinh.string' => 'Giới tính phải là một chuỗi.',

            'trang_thai.required' => 'Bắt buộc nhập Trạng thái .',
            'trang_thai.boolean' => 'Trạng thái không hợp lệ.',
            
            'tieu_su.string' => 'Tiểu sử phải là một chuỗi.',
        ];
    }
}
