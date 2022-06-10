@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.organizations.management'))


@section('content')
    {{ Form::model($organization, ['route' => ['frontend.storeCso', $organization], 'class' => 'form-horizontal content-inner', 'style' =>"width:100%!important"   ,'role' => 'form', 'method' => 'post', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('includes.partials.messages')
        @include('frontend.organizations.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'frontend.index', 'id' => $organization->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
