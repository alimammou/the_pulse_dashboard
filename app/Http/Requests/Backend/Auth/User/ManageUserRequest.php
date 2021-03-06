<?php

namespace App\Http\Requests\Backend\Auth\User;

use App\Enums\UserStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest.
 */
class ManageUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-user-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trashed' => 'boolean',
            'status' => new EnumValue(UserStatus::class),
        ];
    }
}
