<?php

namespace App\View\Components\Admin\Fields;

use App\Enums\Neutrality;

class NeutralityField extends DropDownField
{
    public function __construct(
        string $name,
        string $placeholder,
        ?bool $required = false,
    ) {
        $values=Neutrality::asSelectArray();
        $array=array();
        foreach ($values as $key =>  $value)
        {
            if($key=='against')
            {
                $array[$key]='Moderately with';

            }
            elseif($key=='with')
            {
                $array[$key]='Totally With';

            }
            else
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
