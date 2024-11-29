<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerQuangCaoRequest extends FormRequest
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
            'vi_tri' => 'required|string|max:255',
            'mo_ta' => 'required|nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'vi_tri.required' => 'Vị trí không được để trống.',
            'vi_tri.string' => 'Vị trí phải là chuỗi.',
            'vi_tri.max' => 'Vị trí không được vượt quá 255 ký tự.',

            'mo_ta.required' => 'Mô tả không được để trống.',
            'mo_ta.string' => 'Mô tả phải là chuỗi.',
            'mo_ta.max' => 'Mô tả không được vượt quá 255 ký tự.',
        ];
    }
}
