<?php

Breadcrumbs::for('admin.coalitions.index', function ($trail) {
    $trail->push(__('labels.backend.coalitions.management'), route('admin.coalitions.index'));
});

Breadcrumbs::for('admin.coalitions.create', function ($trail) {
    $trail->parent('admin.coalitions.index');
    $trail->push(__('labels.backend.coalitions.management'), route('admin.coalitions.create'));
});

Breadcrumbs::for('admin.coalitions.edit', function ($trail, $id) {
    $trail->parent('admin.coalitions.index');
    $trail->push(__('labels.backend.coalitions.management'), route('admin.coalitions.edit', $id));
});
