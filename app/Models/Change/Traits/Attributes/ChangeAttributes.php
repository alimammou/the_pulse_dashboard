<?php

namespace App\Models\Change\Traits\Attributes;

use App\Models\Auth\User;
use App\Storages\FileStorageFactory;

trait ChangeAttributes
{
    public function getActionButtonsAttribute(): string
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
            $this->getEditButtonAttribute('edit-organization', 'admin.notifications.edit').
            '</div>';
    }
    public function getACreatorAttribute()
    {
        return User::where('id',$this->id)->get()->name();
    }

}
