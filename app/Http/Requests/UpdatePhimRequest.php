<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhimRequest extends FormRequest
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
            'ten_phim' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'thoi_luong' => 'required|integer',
            'ngay_khoi_chieu' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_khoi_chieu',
            'dao_dien_ids' => 'required|array',
            'dao_dien_ids.*' => 'exists:dao_diens,id',
            'dien_vien_ids' => 'required|array',
            'dien_vien_ids.*' => 'exists:dien_viens,id',
            'vai_tro_dien_vien' => 'required|array',
            'vai_tro_dien_vien.*' => 'string',
            'the_loai_phim_ids' => 'required|array',
            'the_loai_phim_ids.*' => 'exists:the_loai_phims,id',
        ];
    }

    public function messages()
    {
        return [
            'ten_phim.required' => 'Tên phim là bắt buộc.',
            'ten_phim.string' => 'Tên phim phải là một chuỗi ký tự.',
            'ten_phim.max' => 'Tên phim không được vượt quá 255 ký tự.',
            'mo_ta.string' => 'Mô tả phải là một chuỗi ký tự.',
            'thoi_luong.required' => 'Thời lượng là bắt buộc.',
            'thoi_luong.integer' => 'Thời lượng phải là một số nguyên.',
            'ngay_khoi_chieu.required' => 'Ngày khởi chiếu là bắt buộc.',
            'ngay_khoi_chieu.date' => 'Ngày khởi chiếu phải là một ngày hợp lệ.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày khởi chiếu.',
            'dao_dien_ids.required' => 'Danh sách đạo diễn là bắt buộc.',
            'dao_dien_ids.array' => 'Danh sách đạo diễn phải là một mảng.',
            'dao_dien_ids.*.exists' => 'Đạo diễn được chọn không hợp lệ.',
            'dien_vien_ids.required' => 'Danh sách diễn viên là bắt buộc.',
            'dien_vien_ids.array' => 'Danh sách diễn viên phải là một mảng.',
            'dien_vien_ids.*.exists' => 'Diễn viên được chọn không hợp lệ.',
            'vai_tro_dien_vien.required' => 'Vai trò diễn viên là bắt buộc.',
            'vai_tro_dien_vien.array' => 'Vai trò diễn viên phải là một mảng.',
            'vai_tro_dien_vien.*.string' => 'Vai trò của từng diễn viên phải là chuỗi ký tự.',
            'the_loai_phim_ids.required' => 'Danh sách thể loại phim là bắt buộc.',
            'the_loai_phim_ids.array' => 'Danh sách thể loại phim phải là một mảng.',
            'the_loai_phim_ids.*.exists' => 'Thể loại phim được chọn không hợp lệ.',
        ];
    }
}
