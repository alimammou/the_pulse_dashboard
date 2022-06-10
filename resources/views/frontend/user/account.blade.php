@extends('frontend.layouts.app')

@section('content')
    <div class="divMain">
        <div class="divCustomContainer">
            <div class="divMContent dMCNews">
                <div class="divSecMain dSMNewsMain">
                    <div class="dSMTop">
                        <h3 class="headingSMT">Account</h3>
                        <a class="linkSMT" href="{{route('frontend.index')}}">
                            <p class="paraLSMT">Back to dashboard</p>
                        </a>
                    </div>
                    <div class="divAccount">
                        <div class="tabsAccount">
                            <ul class="nav nav-tabs tATabItems" role="tablist">
                                <li class="nav-item tATITab" role="presentation">
                                    <a class="nav-link active linkTATIT"
                                       role="tab" data-toggle="tab"
                                       href="#tab-1">General</a>
                                </li>
                                <li class="nav-item tATITab" role="presentation">
                                    <a class="nav-link linkTATIT"
                                       role="tab" data-toggle="tab"
                                       href="#tab-2">Tab 2</a>
                                </li>
                                <li class="nav-item tATITab" role="presentation">
                                    <a class="nav-link linkTATIT"
                                       role="tab" data-toggle="tab"
                                       href="#tab-3">Tab 3</a>
                                </li>
                            </ul>
                            <div class="tab-content tATabsContent">
                                <div class="tab-pane fade show active tATCPan" role="tabpanel" id="tab-1">
                                    <div class="divTATCPHolder">
                                        <div class="divTATCP">
                                            <p class="paraTATCP pTATCP">First name:</p>
                                            <p class="paraTATCP">{{$logged_in_user->name}}</p>
                                            <a class="linkTATCP"
                                               href="#">Action Not Available</a>
                                        </div>
                                        <div class="divTATCP">
                                            <p class="paraTATCP pTATCP">Position:</p>
                                            <p class="paraTATCP">{{$logged_in_user->position}}</p>
                                            <a class="linkTATCP"
                                               href="#">Action Not Available</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tATCPan" role="tabpanel" id="tab-2">
                                </div>
                                <div class="tab-pane fade tATCPan" role="tabpanel" id="tab-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
