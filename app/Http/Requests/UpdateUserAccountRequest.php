<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/|unique:users,username,' . $this->user->id,
            'email' => 'nullable|email|unique:users,email,' . $this->user->id,
        ];
    }
}
