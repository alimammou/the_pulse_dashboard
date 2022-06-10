<?php

Breadcrumbs::for('admin.notifications.index', function ($trail) {
    $trail->push("NOTIFICATIONS", route('admin.notifications.index'));
});

Breadcrumbs::for('admin.notifications.edit', function ($trail, $id) {
    $trail->parent('admin.notifications.index');
    $trail->push(__('labels.backend.organizations.management'), route('admin.notifications.edit', $id));
});
