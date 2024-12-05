<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaiVietTinTucRequest extends FormRequest
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
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'tom_tat' => 'required|string|max:500',
            'hinh_anh' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ngay_dang' => 'required|date',
            'danh_muc_bai_viet_tin_tuc_id' => 'required|exists:danh_muc_bai_viet_tin_tucs,id',
        ];
    }

    public function messages()
    {
        return [
            'tieu_de.required' => 'Vui lòng nhập tên bài viết.',
            'tieu_de.max' => 'Tên bài viết không được vượt quá 255 ký tự.',

            'noi_dung.required' => 'Vui lòng nhập nội dung bài viết.',
            'noi_dung.string' => 'Nội dung bài viết phải là văn bản.',

            'tom_tat.required' => 'Vui lòng nhập tóm tắt.',
            'tom_tat.string' => 'Tóm tắt phải là văn bản.',
            'tom_tat.max' => 'Tóm tắt không được vượt quá 500 ký tự.',

            'hinh_anh.required' => 'Vui lòng chọn hình ảnh.',
            'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, gif.',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 2MB.',

            'ngay_dang.required' => 'Vui lòng chọn ngày đăng.',
            'ngay_dang.date' => 'Ngày đăng phải là một ngày hợp lệ.',
            'ngay_dang.before' => 'Ngày đăng phải trước ngày hiện tại.',

            'danh_muc_bai_viet_tin_tuc_id.required' => 'Vui lòng chọn danh mục bài viết.',
            'danh_muc_bai_viet_tin_tuc_id.exists' => 'Danh mục bài viết không hợp lệ.',
        ];
    }
}
