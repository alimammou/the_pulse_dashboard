<?php

namespace App\Http\Requests\Backend\Coalitions;

use Illuminate\Foundation\Http\FormRequest;

class EditCoalitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('edit-coalition');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
