<?php

namespace App\Models\Traits;

trait IsActiveAttribute
{
    public function getIsActiveIconAttribute()
    {
        if ($this->is_active) {
            $icon_class = 'check';
            $title = 'Active';
        } else {
            $icon_class = 'times';
            $title = 'Inactive';
        }

        return '<i data-toggle="tooltip" data-placement="top" title="'.$title.'" class="fa fa-'.$icon_class.'"></i>';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
