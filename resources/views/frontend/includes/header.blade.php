<div class="navbar navbar-expand-lg  navbar-static">
    <div class="d-flex flex-1 d-lg-none">

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-transmission" style="color: white"></i>
        </button>
    </div>

    <div class="navbar-brand text-center text-lg-left">
        <a href="/" class="d-inline-block">
            <img src="{{asset("/images/logo.svg")}}" style="height: 54px;" class="d-none d-sm-block" alt="">
        </a>
    </div>

    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">

        <ul class="navbar-nav ml-lg-auto">
        </ul>
    </div>
    @if(auth()->user())
    <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
        <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
            <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
                <img src="{{asset("images/profile.jpg")}}" class="rounded-pill mr-lg-2" height="34" alt="">
                <span class="d-none d-lg-inline-block">{{auth()->user()->name}}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" >
                        <i class="icon-switch2"></i>
                        <span style="color:#000000;">{{trans('navs.general.logout')}}</span>
                    </button>
                </form>
            </div>
        </li>
    </ul>
    @endif
</div>
