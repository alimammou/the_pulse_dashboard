<?php

namespace App\Http\Requests\Backend\Coalitions;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCoalitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return access()->allow('delete-coalition');
    }

    public function rules(): array
    {
        return [
        ];
    }
}
