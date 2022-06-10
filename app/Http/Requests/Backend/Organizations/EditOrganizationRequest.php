<?php

namespace App\Http\Requests\Backend\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class EditOrganizationRequest extends FormRequest
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
