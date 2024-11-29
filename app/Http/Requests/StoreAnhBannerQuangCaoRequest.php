<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnhBannerQuangCaoRequest extends FormRequest
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
            'hinh_anh' => 'required|image|mimes:jpg,jpeg,png,gif',
            'thu_tu' => 'required|integer|min:1'
        ];
    }

    public function message()
    {
        return [
            'hinh_anh.required' => 'Vui lòng chọn một hình ảnh.',
            'hinh_anh.image' => 'File phải là hình ảnh.',
            'hinh_anh.mimes' => 'Ảnh chỉ được có định dạng: jpg, jpeg, png, hoặc gif.',
            'thu_tu.required' => 'Trường thứ tự là bắt buộc.',
            'thu_tu.integer' => 'Trường thứ tự phải là số nguyên.',
            'thu_tu.min' => 'Thứ tự phải lớn hơn hoặc bằng 1.',
        ];
    }
}
