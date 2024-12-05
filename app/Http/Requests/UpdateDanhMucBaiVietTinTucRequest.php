<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDanhMucBaiVietTinTucRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'ten_danh_muc' => 'required|string|max:255|unique:danh_muc_bai_viet_tin_tucs,ten_danh_muc,' . $this->route('danh_muc_bai_viet_tin_tuc'),
    //     ];
    // }

    // public function message()
    // {
    //     return [
    //         'ten_danh_muc.required' => 'Vui lòng nhập tên danh mục.',
    //         'ten_danh_muc.string' => 'Tên danh mục phải là một chuỗi.',
    //         'ten_danh_muc.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
    //         'ten_danh_muc.unique' => 'Tên danh mục này đã tồn tại.',
    //     ];
    // }
}