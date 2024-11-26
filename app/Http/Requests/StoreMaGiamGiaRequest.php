<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaGiamGiaRequest extends FormRequest
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
            'ten_ma_giam_gia' => 'required|string|max:255',
            'ma_giam_gia' => 'required|string|max:50|unique:ma_giam_gias,ma_giam_gia',
            'so_luong' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'ngay_bat_dau' => 'required|date|before_or_equal:ngay_ket_thuc',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            'gia_tri_giam' => 'required|integer|between:1,100',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_ma_giam_gia.required' => 'Tên mã giảm giá không được để trống.',
            'ten_ma_giam_gia.string' => 'Tên mã giảm giá phải là chuỗi ký tự.',
            'ten_ma_giam_gia.max' => 'Tên mã giảm giá không được vượt quá 255 ký tự.',

            'ma_giam_gia.required' => 'Mã giảm giá không được để trống.',
            'ma_giam_gia.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'ma_giam_gia.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'ma_giam_gia.unique' => 'Mã giảm giá này đã tồn tại.',

            'so_luong.required' => 'Số lượng không được để trống.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',

            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',

            'ngay_bat_dau.required' => 'Ngày bắt đầu không được để trống.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là định dạng ngày hợp lệ.',
            'ngay_bat_dau.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',

            'ngay_ket_thuc.required' => 'Ngày kết thúc không được để trống.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',

            'gia_tri_giam.required' => 'Giá trị giảm không được để trống.',
            'gia_tri_giam.integer' => 'Giá trị giảm phải là số nguyên.',
            'gia_tri_giam.between' => 'Giá trị giảm phải nằm trong khoảng từ 1% đến 100%.',
        ];
    }
}