<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoAnRequest extends FormRequest
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
            'hinh_anh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mo_ta' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'ten_do_an.required' => 'Tên đồ ăn là bắt buộc.',
            'ten_do_an.string' => 'Tên đồ ăn phải là một chuỗi ký tự.',
            'ten_do_an.max' => 'Tên đồ ăn không được vượt quá 255 ký tự.',

            'gia.required' => 'Giá là bắt buộc.',
            'gia.numeric' => 'Giá phải là một số.',
            'gia.min' => 'Giá phải lớn hơn hoặc bằng 0.',

            'hinh_anh.required' => 'Hình ảnh là bắt buộc.',
            'hinh_anh.image' => 'Hình ảnh phải là một file ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 2MB.',

            'mo_ta.string' => 'Mô tả phải là một chuỗi ký tự.',

            'luot_mua.integer' => 'Lượt mua phải là số nguyên.',
            'luot_mua.min' => 'Lượt mua phải lớn hơn hoặc bằng 0.',

            'trang_thai.required' => 'Trạng thái là bắt buộc.',
            'trang_thai.boolean' => 'Trạng thái phải là đúng hoặc sai.',
        ];
    }
}
