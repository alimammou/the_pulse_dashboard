<?php

namespace App\View\Components\Admin\Fields;

use App\Enums\weapons;

class WeaponsField extends DropDownField
{
    public function __construct(
        string $name,
        string $placeholder,
        ?bool $required = false,
    ) {
        $values=weapons::asSelectArray();
        $array=array();
        foreach ($values as $key =>  $value)
        {
            $array[$key]=$key;
        }
        parent::__construct(
            name: $name,
            values: $array,
            placeholder: $placeholder,
            required: $required,
        );
    }
}
