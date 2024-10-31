<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuatChieuRequest extends FormRequest
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
            'phong_chieu_id' => 'required|exists:phong_chieus,id',
            'phim_id' => 'required|exists:phims,id',
            'gio_bat_dau' => 'required',
            'gio_ket_thuc' => 'required',
            'trang_thai' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'phong_chieu_id.required' => 'bắt buộc nhập Phòng chiếu .',
            'phong_chieu_id.exists' => 'Phòng chiếu không hợp lệ.',
            'phim_id.required' => 'bắt buộc nhập Phim .',
            'phim_id.exists' => 'Phim không hợp lệ.',
            'gio_bat_dau.required' => 'bắt buộc nhập Giờ bắt đầu .',
            'gio_ket_thuc.required' => 'bắt buộc nhập Giờ kết thúc .',
            'trang_thai.required' => 'Trạng thái là bắt buộc.',

        ];
    }
}
