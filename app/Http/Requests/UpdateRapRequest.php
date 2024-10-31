<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRapRequest extends FormRequest
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
            'ten_rap' => 'required|string|max:255',
            'dia_diem' => 'required|string|max:255',
            'trang_thai' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'ten_rap.required' => 'Tên rạp là bắt buộc.',
            'dia_diem.required' => 'Địa điểm là bắt buộc.',
            'trang_thai.required' => 'Trạng thái là bắt buộc.',
        ];
    }
}
