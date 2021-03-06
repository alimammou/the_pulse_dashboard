<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link {{--}}
{{--                    active_class(Route::is('admin/dashboard'))--}}
{{--                }}" href="{{ route('admin.dashboard') }}">--}}
{{--                    <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                    @lang('menus.backend.sidebar.dashboard')--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @can('view-access-management')
                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon fas fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        @can('view-user-management')
                            <li class="nav-item">
                                <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                    @lang('labels.backend.access.users.management')

                                    @if ($pending_approval > 0)
                                        <span class="badge badge-danger">{{ $pending_approval }}</span>
                                    @endif
                                </a>
                            </li>
                        @endcan
                        @can('view-role-management')
                            <li class="nav-item">
                                <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                    @lang('labels.backend.access.roles.management')
                                </a>
                            </li>
                        @endcan

                        @can('view-permission-management')
                            <li class="nav-item">
                                <a class="nav-link {{
                                active_class(Route::is('admin/auth/permission*'))
                            }}" href="{{ route('admin.auth.permission.index') }}">
                                    @lang('labels.backend.access.permissions.management')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="divider"></li>
            @endcan

            @can('view-organizations')
                <li class="nav-item">
                    <a class="nav-link {{
                                active_class(Route::is('admin/organizations*'))
                            }}" href="{{ route('admin.organizations.index') }}">
                        @lang('labels.backend.sidebar.organizations')
                    </a>
                </li>
            @endcan
            @can('view-organizations')
                <li class="nav-item">
                    <a class="nav-link {{
                                active_class(Route::is('admin/coalitions*'))
                            }}" href="{{ route('admin.coalitions.index') }}">
                        @lang('labels.backend.sidebar.coalitions')
                    </a>
                </li>
            @endcan
            @can('view-notifications')
                <li class="nav-item">
                    <a class="nav-link {{
                                active_class(Route::is('admin/notifications*'))
                            }}" href="{{ route('admin.notifications.index') }}">
                        CSO Update Request
                    </a>
                </li>
            @endcan
{{--            @can('view-logs')--}}
{{--                <li class="nav-item nav-dropdown {{--}}
{{--                    active_class(Route::is('admin/log-viewer*'), 'open')--}}
{{--                }}">--}}
{{--                    <a class="nav-link nav-dropdown-toggle {{--}}
{{--                            active_class(Route::is('admin/log-viewer*'))--}}
{{--                        }}" href="#">--}}
{{--                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')--}}
{{--                    </a>--}}

{{--                    <ul class="nav-dropdown-items">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                            active_class(Route::is('admin/log-viewer'))--}}
{{--                        }}" href="{{ route('log-viewer::dashboard') }}">--}}
{{--                                @lang('menus.backend.log-viewer.dashboard')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                            active_class(Route::is('admin/log-viewer/logs*'))--}}
{{--                        }}" href="{{ route('log-viewer::logs.list') }}">--}}
{{--                                @lang('menus.backend.log-viewer.logs')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
