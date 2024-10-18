<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePhongChieuRequest extends FormRequest
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
            'rap_id' => 'required',
            'ten_phong_chieu' => 'required',
        ];
    }
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (!$this->failedRap()) {
                $validator->errors()->add('rap_id', 'Trường rạp là bắt buộc!');
            }
        });
    }
    public function failedRap()
    {
        $rap = $this->input('rap_id');
        if ($rap == 0) {
            return false;
        }
        return true;
    }
}
