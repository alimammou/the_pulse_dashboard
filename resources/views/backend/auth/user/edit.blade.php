@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

    {{ Form::model($user, ['route' => ['admin.auth.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
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

                    @if ($user->id != 1)

                        <div class="form-group row">
                            {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::checkbox('status', \App\Enums\UserStatus::Active, $user->status == \App\Enums\UserStatus::Active) }}
                            </div>
                        </div>
                        <!--form control-->

                        <div class="form-group row">
                            {{ Form::label('associated_roles', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-md-2 control-label']) }}

                            <div class="col-md-8">
                                @if (count($roles) > 0)
                                    @foreach($roles as $role)
                                        <label for="role-{{$role->id}}" class="control">
                                            <input type="radio" value="{{$role->id}}" name="assignees_roles[]"
                                                   {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}"
                                                   class="get-role-for-permissions"/> &nbsp;&nbsp;{!! $role->name !!}
                                        </label>
                                        <!--permission list-->
                                    @endforeach
                                @else
                                    {{ trans('labels.backend.access.users.no_roles') }}
                                @endif
                            </div>
                            <!--col-lg-3-->
                        </div>
                        <!--form control-->

                        <div class="form-group row">
                            {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10 search-permission">
                                <div id="available-permissions">
                                    <div>
                                        <input type="text" class="form-control search-button" placeholder="Search..."/>
                                    </div>
                                    <div class="get-available-permissions">
                                        @if ($permissions)
                                            @foreach ($permissions as $id => $display_name)
                                                <div>
                                                    <input type="checkbox" name="permissions[{{ $id }}]"
                                                           value="{{ $id }}"
                                                           id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} />
                                                    <label for="perm_{{ $id }}"
                                                           style="margin-left:20px;">{{ $display_name }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>There are no available permissions.</p>
                                        @endif
                                    </div>
                                    <!--col-lg-6-->

                                </div>
                                <!--available permissions-->
                            </div>
                            <!--col-lg-3-->
                        </div>
                        <!--form control-->
                    @endif
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->

        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auth.user.index', 'id' => $user->id ])
    </div>
    <!--card-->
    @if ($user->id == 1)
        {{ Form::hidden('status', \App\Enums\UserStatus::Active) }}
        {{ Form::hidden('assignees_roles[]', 1) }}
    @endif

    {{ Form::close() }}
@endsection

@section('page-script')
    <script>
        XonBoard.Utils.documentReady(function () {
            XonBoard.Users.edit.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            XonBoard.Users.edit.init();
        });
    </script>
@endsection
