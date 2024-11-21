<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaGiamGiaRequest extends FormRequest
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
            'ten_ma_giam_gia' => 'required|string|max:255',
            // 'ma_giam_gia' => 'required|string|max:50|unique:ma_giam_gias,ma_giam_gia,' . $this->route('ma_giam_gium')->id,
            'so_luong' => 'required|integer|min:0',
            'mo_ta' => 'nullable|string',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'gia_tri_giam' => 'required|numeric|min:0|max:100',
        ];
    }

    public function message()
    {
        return [
            'ten_ma_giam_gia.required' => 'Tên mã giảm giá là bắt buộc.',
            'ten_ma_giam_gia.string' => 'Tên mã giảm giá phải là chuỗi văn bản.',
            'ten_ma_giam_gia.max' => 'Tên mã giảm giá không được vượt quá 255 ký tự.',

            'ma_giam_gia.required' => 'Mã giảm giá là bắt buộc.',
            'ma_giam_gia.string' => 'Mã giảm giá phải là chuỗi văn bản.',
            'ma_giam_gia.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'ma_giam_gia.unique' => 'Mã giảm giá này đã tồn tại.',

            'so_luong.required' => 'Số lượng là bắt buộc.',
            'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'so_luong.min' => 'Số lượng phải là một số dương hoặc bằng 0.',

            'mo_ta.string' => 'Mô tả phải là chuỗi văn bản.',

            'ngay_bat_dau.required' => 'Ngày bắt đầu là bắt buộc.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',

            'ngay_ket_thuc.required' => 'Ngày kết thúc là bắt buộc.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',

            'gia_tri_giam.required' => 'Giá trị giảm là bắt buộc.',
            'gia_tri_giam.numeric' => 'Giá trị giảm phải là một số.',
            'gia_tri_giam.min' => 'Giá trị giảm không thể nhỏ hơn 0.',
            'gia_tri_giam.max' => 'Giá trị giảm không thể lớn hơn 100.',
        ];
    }
}