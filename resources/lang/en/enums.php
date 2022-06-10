<?php

use App\Enums\UserStatus;

return [
    UserStatus::class => [
        UserStatus::Active => 'Active',
        UserStatus::Inactive => 'Inactive',
    ],
];
