<?php

namespace App\Http\Requests\Backend\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('create-organization');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
