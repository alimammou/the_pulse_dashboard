<?php

namespace App\Http\Requests\Backend\Auth\User;

use App\Enums\UserStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->segment(4),
            'assignees_roles' => 'required',
            'status' => new EnumValue(UserStatus::class),
        ];

        if ($this->route('user')->id != 1) {
            $rules['permissions'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the validation massages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'assignees_roles' => 'Please Select Role',
        ];
    }
}
