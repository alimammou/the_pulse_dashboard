<?php

Breadcrumbs::for('admin.organizations.index', function ($trail) {
    $trail->push(__('labels.backend.organizations.management'), route('admin.organizations.index'));
});

Breadcrumbs::for('admin.organizations.create', function ($trail) {
    $trail->parent('admin.organizations.index');
    $trail->push(__('labels.backend.organizations.management'), route('admin.organizations.create'));
});

Breadcrumbs::for('admin.organizations.edit', function ($trail, $id) {
    $trail->parent('admin.organizations.index');
    $trail->push(__('labels.backend.organizations.management'), route('admin.organizations.edit', $id));
});
Breadcrumbs::for('admin.organizations.get-coalitions', function ($trail, $id) {
    $trail->parent('admin.organizations.index');
    $trail->push(__('labels.backend.organizations.management'), route('admin.organizations.edit', $id));
});
