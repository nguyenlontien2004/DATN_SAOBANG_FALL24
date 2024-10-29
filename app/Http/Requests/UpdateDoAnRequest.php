<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoAnRequest extends FormRequest
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
        'ten_do_an' => 'required|string|max:255',
        'gia' => 'required|numeric|min:0',
        'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'mo_ta' => 'required|string|max:500',
        'luot_mua' => 'required|integer|min:0',
        'trang_thai' => 'required|boolean',
    ];
}

public function messages()
{
    return [
        'ten_do_an.required' => 'Tên đồ ăn không được để trống.',
        'ten_do_an.string' => 'Tên đồ ăn phải là chuỗi ký tự.',
        'ten_do_an.max' => 'Tên đồ ăn không được vượt quá 255 ký tự.',

        'gia.required' => 'Giá không được để trống.',
        'gia.numeric' => 'Giá phải là số.',
        'gia.min' => 'Giá phải lớn hơn hoặc bằng 0.',

        'hinh_anh.image' => 'Hình ảnh phải là định dạng ảnh.',
        'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
        'hinh_anh.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',

        'mo_ta.required' => 'Mô tả không được để trống.',
        'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        'mo_ta.max' => 'Mô tả không được vượt quá 500 ký tự.',

        'luot_mua.required' => 'Lượt mua không được để trống.',
        'luot_mua.integer' => 'Lượt mua phải là số nguyên.',
        'luot_mua.min' => 'Lượt mua phải lớn hơn hoặc bằng 0.',

        'trang_thai.required' => 'Trạng thái không được để trống.',
        'trang_thai.boolean' => 'Trạng thái phải là giá trị hợp lệ.',
    ];
}

}