<?php

namespace App\Http\Requests\Backend\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class DeleteOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('delete-organization');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
