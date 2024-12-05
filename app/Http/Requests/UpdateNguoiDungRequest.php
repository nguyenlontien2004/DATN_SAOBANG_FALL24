<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNguoiDungRequest extends FormRequest
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

    //     $userID = $this->route('nguoi_dung');
    //     // dd($userID);
    //     return [
    //         'vai_tros' => 'required|exists:vai_tros,id',
    //         'ho_ten' => 'required|string|max:255|unique:nguoi_dungs,ho_ten,' . $userID,
    //         'email' => 'required|email|unique:nguoi_dungs,email,' . $userID,
    //         'so_dien_thoai' => 'required|unique:nguoi_dungs,so_dien_thoai,' . $userID,
    //         // |regex:/^([0-9]{10,11})$/|
    //         'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif',
    //         'gioi_tinh' => 'required|in:Nam,Nữ,Khác',
    //         'dia_chi' => 'required|string|max:255',
    //         'nam_sinh' => 'required|date|before:today',
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'vai_tros.required' => 'Vui lòng chọn vai trò.',
    //         'vai_tros.exists' => 'Vai trò không tồn tại.',

    //         'ho_ten.required' => 'Vui lòng nhập họ tên.',
    //         'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',

    //         'email.required' => 'Vui lòng nhập email.',
    //         'email.email' => 'Email không đúng định dạng.',
    //         'email.unique' => 'Email này đã được sử dụng.',

    //         'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
    //         // 'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ.',
    //         'so_dien_thoai.unique' => 'Số điện thoại này đã được sử dụng.',

    //         'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
    //         'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png hoặc gif.',

    //         'gioi_tinh.required' => 'Vui lòng chọn giới tính.',
    //         'gioi_tinh.in' => 'Giới tính không hợp lệ.',

    //         'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
    //         'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

    //         'nam_sinh.required' => 'Vui lòng nhập năm sinh.',
    //         'nam_sinh.date' => 'Năm sinh phải là ngày hợp lệ.',
    //         'nam_sinh.before' => 'Năm sinh phải trước ngày hiện tại.',
    //     ];
    // }
}