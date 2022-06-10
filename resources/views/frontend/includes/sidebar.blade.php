<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-section sidebar-user my-1">
            <div class="sidebar-section-body">

                <div class="media" style="align-items: center">
                    @if(auth()->user())
                    <a href="#" class="mr-3">
                        <img src="{{asset("images/profile.jpg")}}" class="rounded-circle" alt="">
                    </a>

                    <div class="media-body">
                        <div class="font-weight-semibold">{{auth()->user()->name}}</div>
                        @if(!auth()->user()->email_verified_at)
                            <div class="font-size-sm line-height-sm opacity-50">
                                you account is not verified<a href="/email/verify"> Verify now</a>
                            </div>
                        @endif
                    </div>
                    @else
                        <a href="#" class="mr-3">
                        </a>
                        <div class="media-body">
                            <a class="" style="color:white!important;" href="/login">Login now</a>
                        </div>
                    @endif
                    <div class="ml-3 align-self-center">
                        <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="icon-transmission"></i>
                        </button>

                        <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                            <i class="icon-cross2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item nav-item-submenu nav-item-open">
                    <a class="nav-link {{
                                active_class(Route::is('frontend.index'))
                            }}
                    {{
                        active_class(Route::is('frontend.individual'))
                    }}"><i class="icon-home4 "></i> <span>General Information</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: block;">
                        <li class="nav-item"><a href="/general-information" class="nav-link
{{--{{--}}
{{--                                active_class(Route::is('frontend.index'))--}}
{{--                            }}--}}
                                ">Overall</a></li>
                        <li class="nav-item  {{
                        active_class(Route::is('frontend.individual'))
                    }}"><a href="/general-information/{{\App\Models\Organization\Organization::first()->value('slug')}}" class="nav-link">Individual</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu nav-item-open">
                    <a href="" class="nav-link {{
                                active_class(Route::is('frontend.coalitions'))
                            }}"><i class="icon-home4"></i> <span>Connections</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: block;">
                        <li class="nav-item {{
                                active_class(Route::is('frontend.coalitions'))
                            }}"><a href="{{Route('frontend.coalitions')}}" class="nav-link">Map</a></li>
                        <li class="nav-item {{
                                active_class(Route::is('frontend.coalitions-list'))
                            }}"><a href="{{Route('frontend.coalitions-list')}}" class="nav-link">List</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu nav-item-open">
                    <a href="" class="nav-link {{
                                active_class(Route::is('frontend.dashboard3.overall'))
                            }}
                    {{
                        active_class(Route::is('frontend.dashboard3.individual'))
                    }}"><i class="icon-home4"></i> <span>Political Opinions</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: block;">
                        <li class="nav-item {{
                                active_class(Route::is('frontend.dashboard3.overall'))
                            }}"><a href="{{Route('frontend.dashboard3.overall')}}" class="nav-link">Overall</a></li>
                        <li class="nav-item {{
                        active_class(Route::is('frontend.dashboard3.individual'))
                    }}"><a href="{{Route('frontend.dashboard3.individual',\App\Models\Organization\Organization::first()->value('slug'))}}" class="nav-link">
                                Individual
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu nav-item-open">
                    <a href="" class="nav-link {{
                                active_class(Route::is('frontend.social-media'))
                            }}
                    {{
                        active_class(Route::is('frontend.dashboard3.individual'))
                    }}"><i class="icon-home4"></i> <span>Social Media Analysis</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: block;">
                        <li class="nav-item {{
                                active_class(Route::is('frontend.social-media'))
                            }}"><a href="{{Route('frontend.social-media')}}" class="nav-link">Likes and Followers</a></li>
                        <li class="nav-item {{
                        active_class(Route::is('frontend.social-media-2'))
                    }}"><a href="{{Route('frontend.social-media-2')}}" class="nav-link">
                                Online Presence
                            </a>
                        </li>
                    </ul>
                </li>
                @can('view-backend')
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link">
                            <i  class="fas fa-wrench"></i>
                        <span>Admin Panel</span>

                    </a>
                    </li>
                @endcan
                @if(isset($cs) && $cs!='')
                    <li class="nav-item">
                        <a href="/{{\App\Models\Organization\Organization::where('id',$cs->organization_id)->value('slug')}}/update" class="nav-link">
                            <i  class="fas fa-wrench"></i>
                            <span>Update {{\App\Models\Organization\Organization::where('id',$cs->organization_id)->value('name')}}</span>

                        </a>
                    </li>
                @endif

            </ul>

            <!-- /page kits -->
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
