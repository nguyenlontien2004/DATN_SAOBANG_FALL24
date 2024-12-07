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
            'ten_phim' => 'required|string|max:255|unique:phims,ten_phim,' . $this->route('phim')->id,
            'mo_ta' => 'nullable|string',
            'anh_phim' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'thoi_luong' => 'required|integer',
            'gia_phim' => 'required|numeric|min:0',
            'do_tuoi' => 'required|integer|min:0|max:100', // Độ tuổi yêu cầu phải là số nguyên trong khoảng 0-100
            'luot_xem_phim' => 'integer',
            'ngon_ngu' => 'required|string|max:255',
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
            'ten_phim.unique' => 'tên phim đã tồn tại',
            'ten_phim.string' => 'Tên phim phải là một chuỗi ký tự.',
            'ten_phim.max' => 'Tên phim không được vượt quá 255 ký tự.',
            'anh_phim.image' => 'Ảnh phim phải là một tệp hình ảnh.',
            'anh_phim.mimes' => 'Ảnh phim chỉ hỗ trợ các định dạng: jpeg, png, jpg, gif, svg.',
            'mo_ta.string' => 'Mô tả phải là một chuỗi ký tự.',
            'thoi_luong.required' => 'Thời lượng là bắt buộc.',
            'thoi_luong.integer' => 'Thời lượng phải là một số nguyên.',
            'do_tuoi.required' => 'Độ tuổi là bắt buộc.',
            'do_tuoi.integer' => 'Độ tuổi phải là một số nguyên.',
            'do_tuoi.min' => 'Độ tuổi không thể nhỏ hơn 0.',
            'do_tuoi.max' => 'Độ tuổi không thể lớn hơn 100.',

            'gia_phim.required' => 'Giá phim là bắt buộc.',
            'gia_phim.numeric' => 'Giá phim phải là một số.',
            'gia_phim.min' => 'Giá phim phải lớn hơn hoặc bằng 0.',

            'ngon_ngu.string' => 'Ngôn ngữ lượt xem phải là một chuỗi ký tự.',
            'ngon_ngu.max' => 'Ngôn ngữ lượt xem không được vượt quá 255 ký tự.',
            'ngon_ngu.required' => 'Ngôn ngữ lượt xem là bắt buộc.',

            'luot_xem_phim.integer' => 'Lượt xem phải là một số nguyên.',
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
