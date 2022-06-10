<?php

namespace App\Http\Requests\Backend\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class ManageOrganizationRequest extends FormRequest
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
