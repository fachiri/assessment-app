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
            'nis' => 'nullable|numeric|digits:5|unique:students,nis,' . $this->user->student->id,
            'nisn' => 'required|numeric|digits:10|unique:students,nisn,' . $this->user->student->id,
            'name' => 'required|string|max:32',
            'gender' => 'nullable|in:' . UserGender::MALE . ',' . UserGender::FEMALE,
            'phone' => 'nullable|max:14',
            'birthday' => 'nullable|date',
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/|unique:users,username,' . $this->user->id,
            'email' => 'nullable|email|unique:users,email,' . $this->user->id,
        ];
    }
}
