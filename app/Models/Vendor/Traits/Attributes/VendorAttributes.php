<?php

namespace App\Models\Vendor\Traits\Attributes;

trait VendorAttributes
{
    public function getActionButtonsAttribute(): string
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
            $this->getEditButtonAttribute('edit-vendor', 'admin.vendors.edit').
            $this->getDeleteButtonAttribute('delete-vendor', 'admin.vendors.destroy').
            '</div>';
    }
}
