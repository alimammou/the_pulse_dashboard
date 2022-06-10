<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Active()
 * @method static static Inactive()
 */
final class Status extends Enum
{
    const Active = 'active';

    const Inactive = 'inactive';
}
