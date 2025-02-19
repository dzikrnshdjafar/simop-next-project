<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePicRequest extends FormRequest
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
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|max:14',
            'birthday' => 'nullable|date',
            'gender' => 'required'
        ];
    }
}
