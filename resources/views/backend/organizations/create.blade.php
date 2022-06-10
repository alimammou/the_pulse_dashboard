@extends('backend.layouts.app')

@section('title', __('labels.backend.organizations.management') . ' | ' . __('labels.backend.organizations.create'))

@section('breadcrumb-links')
    @include('backend.organizations.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.organizations.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-organization', 'files' => true]) }}

    <div class="card">
        @include('backend.organizations.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.organizations.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
