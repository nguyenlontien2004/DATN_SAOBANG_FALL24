<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Phim;
use App\Models\SuatChieu;
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
            'gio_bat_dau' => 'required|date_format:H:i',
            'date' => 'required|date|after_or_equal:today',
            'phim_id' => [
                'required',
                'exists:phims,id',
                function ($attribute, $value, $fail) {
                    $phim = Phim::find($this->input('phim_id'));
                    if (!$phim) {
                        $fail('Phim không tồn tại.');
                        return;
                    }

                    $gioBatDauMoi = Carbon::createFromFormat('H:i', $this->input('gio_bat_dau'));
                    $gioKetThucMoi = $gioBatDauMoi->copy()->addMinutes($phim->thoi_luong);

                    $existingShow = SuatChieu::where('phong_chieu_id', $this->input('phong_chieu_id'))
                        ->whereDate('date', $this->input('date'))
                        ->where('id', '!=', $this->route('suatChieu')->id) // Bỏ qua suất chiếu hiện tại
                        ->where(function ($query) use ($gioBatDauMoi, $gioKetThucMoi) {
                            $query->where(function ($subQuery) use ($gioBatDauMoi, $gioKetThucMoi) {
                                $subQuery->whereTime('gio_bat_dau', '<', $gioKetThucMoi->format('H:i')) 
                                    ->whereTime('gio_ket_thuc', '>', $gioBatDauMoi->format('H:i')); 
                            });
                        })
                        ->exists();

                    if ($existingShow) {
                        $fail('Không thể cập nhật suất chiếu. Một suất chiếu đã tồn tại trong khoảng thời gian đã chọn.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'phong_chieu_id.required' => 'bắt buộc nhập Phòng chiếu .',
            'phong_chieu_id.exists' => 'Phòng chiếu không hợp lệ.',

            'phim_id.required' => 'bắt buộc nhập Phim .',
            'phim_id.exists' => 'Phim không hợp lệ.',

            'gio_bat_dau.required' => 'Bạn cần nhập Giờ bắt đầu.',
            'gio_bat_dau.date_format' => 'Giờ bắt đầu phải có định dạng là H:i.',
            'date.required' => 'Bạn cần nhập Ngày chiếu phim.',
            'date.date' => 'Ngày chiếu phim phải có định dạng hợp lệ.',
            'date.after_or_equal' => 'Không được thêm ngày chiếu cũ hơn ngày hiện tại.',
        ];
    }
}
