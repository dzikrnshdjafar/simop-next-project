<?php

namespace App\Http\Requests;

use App\Constants\UserGender;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'gender' => 'nullable|in:' . UserGender::MALE . ',' . UserGender::FEMALE,
            'phone' => 'nullable|max:14',
            'birthday' => 'nullable|date',
        ];
    }
}

