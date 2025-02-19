<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'department' => 'required',
            'gender' => 'nullable',
            'phone' => 'nullable|max:14',
            'birthday' => 'nullable|date',
        ];
    }
}
