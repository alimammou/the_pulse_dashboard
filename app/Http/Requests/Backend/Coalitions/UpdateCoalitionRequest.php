<?php

namespace App\Http\Requests\Backend\Coalitions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoalitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('edit-coalitions');
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:191'],
            'description' => ['nullable'],

        ];
    }
}
