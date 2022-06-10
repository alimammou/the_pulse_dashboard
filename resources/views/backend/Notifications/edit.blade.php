@extends('backend.layouts.app')

@section('title', __('labels.backend.organizations.management') . ' | ' . __('labels.backend.organizations.edit'))

@section('breadcrumb-links')
@endsection
@section('content')
    {{ Form::model($notification, ['route' => ['admin.notifications.update', $notification], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.Notifications.form')
    </div><!--card-->
    {{ Form::close() }}
@endsection
