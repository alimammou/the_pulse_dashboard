<?php

namespace App\Http\Requests\Backend\Coalitions;

use Illuminate\Foundation\Http\FormRequest;

class ManageCoalitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('view-coalition');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
