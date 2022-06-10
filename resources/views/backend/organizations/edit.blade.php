@extends('backend.layouts.app')

@section('title', __('labels.backend.organizations.management') . ' | ' . __('labels.backend.organizations.edit'))

@section('breadcrumb-links')
    @include('backend.organizations.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($organization, ['route' => ['admin.organizations.update', $organization], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.organizations.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.organizations.index', 'id' => $organization->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
