@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    <div class="divMain DMLogin">
        <div class="divLoginLeft" style="width: 100%">
            <div class="divCustomContainer">
                <div class="divLoginHolder">
                    <div class="divLoginHHolder">
                        <h3 class="headingLogin">Login</h3>
                        <div class="divLoginCard">
                            {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                            <i class="fa fa-user-circle loginIcon"></i>

                            {{ html()->email('email')
                            ->class('loginField')
                            ->placeholder('email')
                            ->attribute('maxlength', 191)
                            ->required()
                            }}

                            {{ html()->password('password')
                                                               ->class('loginField')
                                                               ->placeholder('password')
                                                               ->required() }}

                            @validationError('email')
                            @validationError('password')

                            <button class="btn loginButton" type="submit">Login&nbsp;
                                <i class="fa fa-sign-in loginButtonIcon"></i>
                            </button>
                            {{ html()->form()->close() }}
                        </div>
                        <div class="divLoginExtras"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

