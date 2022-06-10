<?php

namespace App\Http\Requests\Backend\Changes;

use Illuminate\Foundation\Http\FormRequest;

class ManageChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('view-organization');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
