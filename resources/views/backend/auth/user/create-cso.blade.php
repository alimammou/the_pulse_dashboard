@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.auth.user.store-cso', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ Form::label('name', __('validation.attributes.backend.access.users.name'), [ 'class'=>'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.name'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('email', __('validation.attributes.backend.access.users.email'), [ 'class'=>'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('password', __('validation.attributes.backend.access.users.password'), [ 'class'=>'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.password'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                        <div class="col-md-10">
                            {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
                                        ->required() }}
                        </div>
                        <!--col-->
                    </div>
                    <div class="form-group row">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::checkbox('status', \App\Enums\UserStatus::Active, \App\Enums\UserStatus::Active) }}
                        </div>
                    </div>
                    <!--form-group-->
                    <div class="form-group row">
                        <label for="cso" class="col-md-2 from-control-label ">CSO</label>

                        <div class="col-md-10">
                            <select class="search-input-select form-control" id="cso" name="cso">
                                <option disabled selected>CSO</option>
                                @foreach(\App\Models\Organization\Organization::all() as $organization)
                                    <option value="{{$organization->id}}">{{$organization->name}}</option>

                                @endforeach
                            </select>    </div>
                        <!--col-->
                    </div>
                    <!--form control-->


                    <!--form-group-->


                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->

        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auth.user.index' ])
    </div>
    <!--card-->
    {{ Form::close() }}
@endsection

@section('page-script')
    <script>
        XonBoard.Utils.documentReady(function() {
            XonBoard.Users.edit.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            XonBoard.Users.edit.init("create");
        });
    </script>
@endsection
