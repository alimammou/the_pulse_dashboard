<?php

namespace App\Models\Coalition\Traits\Attributes;

use App\Storages\FileStorageFactory;

trait CoalitionAttributes
{
    public function getActionButtonsAttribute(): string
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
            $this->getEditButtonAttribute('edit-coalition', 'admin.coalitions.edit').
            $this->getDeleteButtonAttribute('delete-coalition', 'admin.coalitions.destroy').
            '</div>';
    }

}
