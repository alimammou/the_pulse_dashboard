<?php

namespace App\Listeners\Backend\Auth\Permission;

use Illuminate\Events\Dispatcher;
use App\Events\Backend\Auth\Permission\PermissionCreated;
use App\Events\Backend\Auth\Permission\PermissionDeleted;
use App\Events\Backend\Auth\Permission\PermissionUpdated;

class PermissionEventListener
{
    private string $history_slug = 'Permission';

    public function onCreated(PermissionCreated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.created") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    public function onUpdated(PermissionUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.updated") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    public function onDeleted(PermissionDeleted $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->permission->id)
            ->withText('trans("history.backend.permissions.deleted") <strong>'.$event->permission->name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            PermissionCreated::class => 'onCreated',
            PermissionUpdated::class => 'onUpdated',
            PermissionDeleted::class => 'onDeleted',
        ];
    }
}
