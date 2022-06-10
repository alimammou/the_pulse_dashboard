@extends('backend.layouts.app')

@section('title', __('labels.backend.coalitions.management') . ' | ' . __('labels.backend.coalitions.edit'))

@section('breadcrumb-links')
    @include('backend.coalitions.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($coalition, ['route' => ['admin.coalitions.update', $coalition], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.coalitions.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.coalitions.index', 'id' => $coalition->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
