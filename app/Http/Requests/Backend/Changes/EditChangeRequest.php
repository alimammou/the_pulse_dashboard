<?php

namespace App\Http\Requests\Backend\Changes;

use Illuminate\Foundation\Http\FormRequest;

class EditChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('edit-organization');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
