@extends('backend.layouts.app')

@section('title', __('labels.backend.coalitions.management') . ' | ' . __('labels.backend.coalitions.create'))

@section('breadcrumb-links')
    @include('backend.coalitions.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.coalitions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-coalition', 'files' => true]) }}

    <div class="card">
        @include('backend.coalitions.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.coalitions.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
