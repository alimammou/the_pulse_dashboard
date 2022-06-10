<?php

namespace App\Models\Organization\Traits\Attributes;

use App\Storages\FileStorageFactory;

trait OrganizationAttributes
{
    public function getActionButtonsAttribute(): string
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
            $this->getEditButtonAttribute('edit-organization', 'admin.organizations.edit').
            $this->getDeleteButtonAttribute('delete-organization', 'admin.organizations.destroy').
            $this->getEditCoalitionsButtonAttribute('edit-organization','admin.organizations.get-coalitions').
            '</div>';
    }
    public function getEditCoalitionsButtonAttribute($permission, $route)
    {
        if (access()->allow($permission)) {
            return '<a href="'.route($route, $this).'" data-toggle="tooltip" data-placement="top" title="edit Coalitions" class="btn btn-primary btn-light btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>';
        }
    }
    public function getLogoUrlAttribute(): ?string
    {
        if (! $this->logo_name) {
            return null;
        }

        $storage = FileStorageFactory::createForOrganizations();

        return $storage->fullUrl($this->logo_name);
    }
    public function getEconomicPlanUrlAttribute(): ?string
    {
        if (! $this->economic_plan_file) {
            return null;
        }

        $storage = FileStorageFactory::createForOrganizations();

        return $storage->fullUrl($this->economic_plan_file);
    }

}
