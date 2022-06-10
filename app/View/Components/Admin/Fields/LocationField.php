<?php

namespace App\View\Components\Admin\Fields;

use App\Enums\Lcations;

class LocationField extends DropDownField
{
    public function __construct(
        string $name,
        string $placeholder,
        ?bool $required = false,
    ) {
        parent::__construct(
            name: $name,
            values: Lcations::asSelectArray(),
            placeholder: $placeholder,
            required: $required,
        );
    }
}
