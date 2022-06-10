<div class="divTop">
    <div class="divCustomContainer">
        <div class="divT">
            <div class="divTLeft DTLRight">
                <a class="linkNavTopLogoHome" href="{{route('frontend.index')}}">
                    <img class="imgTLDTLRLogo" src="{{asset('img/logo.png')}}">
                </a>
            </div>
            <div class="divTLeft">
                @auth()
                    <div class="divDTLDetails">
                        <p class="paraDTLD">{{$logged_in_user->full_name}}</p>
                        <p class="paraDTLD">{{$logged_in_user->position}}</p>
                    </div>
                    <div class="divIDTLHolder">
                        <img class="imgDTL" src="{{asset('img/User-Icon-Grey-300x300.png')}}">
                        <div class="divNavAccPop">
                            <div class="dNAPMain">
                                <a class="linkNAP" href="{{route('frontend.user.account')}}">Account</a>
                            </div>
                            <a class="linkNAP logout" href="{{route('logout')}}">
                                Logout&nbsp;<i class="fa fa-sign-out loginButtonIcon"></i>
                            </a>
                        </div>
                    </div>
                @endauth

                @guest()
                    <a href="{{route('login')}}">
                        Login&nbsp;<i class="fa fa-sign-out loginButtonIcon"></i>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
