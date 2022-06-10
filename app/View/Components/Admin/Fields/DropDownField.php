<?php

namespace App\View\Components\Admin\Fields;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropDownField extends Component
{
    public array $field_attributes = [];

    public string $required = '';

    public function __construct(
        public string $name,
        public array $values,
        public string $placeholder,
        ?bool $required = false,
    ) {
        if ($required == true) {
            $this->field_attributes += ['required' => 'required'];
            $this->required = 'required';
        }
    }

    public function render(): View
    {
        return view('components.admin.fields.drop-down-field');
    }
}
