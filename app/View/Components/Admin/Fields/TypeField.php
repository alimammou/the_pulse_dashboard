<?php

namespace App\View\Components\Admin\Fields;

use App\Enums\Type;

class TypeField extends DropDownField
{
    public function __construct(
        string $name,
        string $placeholder,
        ?bool $required = false,
    ) {
        $values=Type::asSelectArray();
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
