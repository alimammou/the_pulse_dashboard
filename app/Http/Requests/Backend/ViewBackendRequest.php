<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ViewBackendRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('view-backend');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
