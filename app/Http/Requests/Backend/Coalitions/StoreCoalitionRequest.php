<?php

namespace App\Http\Requests\Backend\Coalitions;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoalitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('create-coalition');
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:191'],
            'description' => ['nullable'],

        ];
    }
}
