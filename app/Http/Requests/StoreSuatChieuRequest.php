<?php

namespace App\Http\Requests;

use App\Models\SuatChieu;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuatChieuRequest extends FormRequest
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
    // public function rules()
    // {
    //     return [
    //         'phong_chieu_id' => 'required|exists:phong_chieus,id',
    //         // 'phim_id' => 'required|exists:phims,id',
    //         'gio_bat_dau' => 'required|date_format:H:i',
    //         'date' => 'required|date',
    //         'gio_ket_thuc' => 'required|date_format:H:i|after:gio_bat_dau',
    //         'phim_id' => [
    //             'required',
    //             'exists:phims,id',
    //             function ($attribute, $value, $fail) {
    //                 $existingShow = SuatChieu::where('phim_id', $value)
    //                     ->where('phong_chieu_id', $this->input('phong_chieu_id')) // Lấy giá trị từ input
    //                     ->whereDate('date', $this->input('date')) // Kiểm tra ngày
    //                     ->where(function ($query) {
    //                         $query->whereBetween('gio_bat_dau', [$this->input('gio_bat_dau'), $this->input('gio_ket_thuc')])
    //                             ->orWhereBetween('gio_ket_thuc', [$this->input('gio_bat_dau'), $this->input('gio_ket_thuc')])
    //                             ->orWhere(function ($query) {
    //                                 $query->where('gio_bat_dau', '<=', $this->input('gio_bat_dau'))
    //                                     ->where('gio_ket_thuc', '>=', $this->input('gio_ket_thuc'));
    //                             });
    //                     })
    //                     ->exists();

    //                 if ($existingShow) {
    //                     $fail('Không thể thêm suất chiếu mới. Một suất chiếu đã tồn tại trong khoảng thời gian đã chọn.');
    //                 }
    //             }
    //         ],
    //     ];
    // }
    public function rules()
    {
        return [
            'phong_chieu_id' => 'required|exists:phong_chieus,id',
            'gio_bat_dau' => 'required|date_format:H:i',
            'date' => 'required|date',
            'gio_ket_thuc' => 'required|date_format:H:i|after:gio_bat_dau',
            'phim_id' => [
                'required',
                'exists:phims,id',
                function ($attribute, $value, $fail) {
                    $existingShow = SuatChieu::where('phong_chieu_id', $this->input('phong_chieu_id'))
                        ->whereDate('date', $this->input('date'))
                        ->where(function ($query) {
                            $query->whereBetween('gio_bat_dau', [$this->input('gio_bat_dau'), $this->input('gio_ket_thuc')])
                                ->orWhereBetween('gio_ket_thuc', [$this->input('gio_bat_dau'), $this->input('gio_ket_thuc')])
                                ->orWhere(function ($query) {
                                    $query->where('gio_bat_dau', '<=', $this->input('gio_bat_dau'))
                                        ->where('gio_ket_thuc', '>=', $this->input('gio_ket_thuc'));
                                });
                        })
                        ->exists();

                    if ($existingShow) {
                        $fail('Không thể thêm suất chiếu mới. Một suất chiếu đã tồn tại trong khoảng thời gian đã chọn.');
                    }
                }
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

            'gio_ket_thuc.required' => 'Bạn cần nhập Giờ kết thúc.',
            'gio_ket_thuc.date_format' => 'Giờ kết thúc phải có định dạng là H:i.',

            'gio_bat_dau.before' => 'Giờ bắt đầu phải trước Giờ kết thúc.',
            'gio_ket_thuc.after' => 'Giờ kết thúc phải sau Giờ bắt đầu.',
        ];
    }
}
