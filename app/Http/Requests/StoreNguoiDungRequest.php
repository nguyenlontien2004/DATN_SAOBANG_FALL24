<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNguoiDungRequest extends FormRequest
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
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:nguoi_dungs,email|max:255',
            'so_dien_thoai' => 'required|string|max:15|unique:nguoi_dungs,so_dien_thoai',
            'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'password' => 'required|string|min:8',
            'gioi_tinh' => 'nullable|string|in:Nam,Nữ,Khác',
            'dia_chi' => 'nullable|string|max:255',
            'nam_sinh' => 'required|date|before:today',
            'vai_tros' => 'required|array|min:1',
            'vai_tros.*' => 'exists:vai_tros,id',
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required' => 'Họ tên là bắt buộc.',
            'ho_ten.string' => 'Họ tên phải là chuỗi văn bản.',
            'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'so_dien_thoai.required' => 'Số điện thoại là bắt buộc.',
            'so_dien_thoai.string' => 'Số điện thoại phải là chuỗi.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'so_dien_thoai.unique' => 'Số điện thoại này đã tồn tại.',

            'hinh_anh.image' => 'Hình ảnh phải là tệp hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png, hoặc gif.',
            'hinh_anh.max' => 'Dung lượng hình ảnh không được vượt quá 2MB.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi văn bản.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

            'gioi_tinh.in' => 'Giới tính phải là Nam, Nữ hoặc Khác.',

            'nam_sinh.required' => 'Năm sinh là bắt buộc.',
            'nam_sinh.date' => 'Năm sinh phải là một ngày hợp lệ.',
            'nam_sinh.before' => 'Năm sinh phải trước ngày hôm nay.',

            'vai_tros.required' => 'Vai trò là bắt buộc.',
            'vai_tros.array' => 'Vai trò phải là một mảng.',
            'vai_tros.min' => 'Phải chọn ít nhất một vai trò.',
            'vai_tros.*.exists' => 'Một trong các vai trò không tồn tại.',
        ];
    }
}
