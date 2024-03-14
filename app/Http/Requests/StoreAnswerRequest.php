<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $assessment = request('assessment');
        $rules = [];

        foreach ($assessment->questions as $question) {
            $rules[$question->uuid] = $question->required == 1 ? 'required' : 'nullable';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => 'Wajib Diisi!',
        ];
    }
}
