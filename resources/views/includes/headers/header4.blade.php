<header id="wt-header" class="wt-header wt-headereleven wt-headerelevenb">
    <div class="wt-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if (!empty($logo) || Schema::hasTable('site_managements'))
                        <strong class="wt-logo"><a href="{{{ url('/') }}}"><img src="{{{ asset($logo) }}}" alt="{{{ trans('Logo') }}}"></a></strong>
                    @endif
                    <div class="wt-rightarea">
                        @if (file_exists(resource_path('views/extend/includes/menu.blade.php'))) 
                            @include('extend.includes.menu')
                        @else 
                            @include('includes.menu')
                        @endif
                        @guest
                            <div class="wt-loginarea">
                                <div class="wt-loginoption wt-loginoptionvtwo">
                                    <a href="javascript:void(0);" id="wt-loginbtn" class="wt-btn">{{{trans('lang.sign_in') }}}</a>
                                    <div class="wt-loginformhold">
                                        <div class="wt-loginheader">
                                            <span>{{{trans('lang.sign_in') }}}</span>
                                            <a href="javascript:;"><i class="fa fa-times"></i></a>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}"class="wt-formtheme wt-loginform do-login-form">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group">
                                                    <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        placeholder="Email" required autofocus>
                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                        placeholder="Password" required>
                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="wt-logininfo">
                                                    <button href="javascript:;"  type="submit" class="wt-btn do-login-button">{{{ trans('lang.sign_in') }}}</button>
                                                    <span class="wt-checkbox">
                                                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">{{{ trans('lang.keep_me_logged_in') }}}</label>
                                                    </span>
                                                </div>
                                            </fieldset>
                                            <div class="wt-loginfooterinfo">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="wt-forgot-password">{{{ trans('lang.forget_pass') }}}</a>
                                                @endif
                                                <a href="{{{ route('register') }}}">{{{ trans('lang.create_account') }}}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="{{{ route('register') }}}" class="wt-btn">{{{ trans('lang.join_now') }}}</a>
                            </div>
                        @endguest
                        @auth
                            @php
                                $user = !empty(Auth::user()) ? Auth::user() : '';
                                $role = !empty($user) ? $user->getRoleNames()->first() : array();
                                $profile = \App\User::find(Auth::user()->id)->profile;
                                $user_image = !empty($profile) ? $profile->avater : '';
                                $employer_job = \App\Job::select('status')->where('user_id', Auth::user()->id)->first();
                                $profile_image = !empty($user_image) ? '/uploads/users/'.$user->id.'/'.$user_image : 'images/user-login.png';
                                $payment_settings = \App\SiteManagement::getMetaValue('commision');
                                $payment_module = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
                                $employer_payment_module = !empty($payment_settings) && !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
                            @endphp
                            <div class="wt-userlogedin">
                                <figure class="wt-userimg">
                                    <img src="{{{ asset(Helper::getImage('uploads/users/' . Auth::user()->id, $profile->avater, '' , 'user.jpg')) }}}" alt="{{{ trans('lang.user_avatar') }}}">
                                </figure>
                                <div class="wt-username">
                                    <h3>{{{ Helper::getUserName(Auth::user()->id) }}}</h3>
                                    <span>{{{ !empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Helper::getAuthRoleName() }}}</span>
                                </div>
                                @if (file_exists(resource_path('views/extend/back-end/includes/profile-menu.blade.php'))) 
                                    @include('extend.back-end.includes.profile-menu')
                                @else 
                                    @include('back-end.includes.profile-menu')
                                @endif
                                {{-- <nav class="wt-usernav">
                                    <ul>
                                        <li class="menu-item-has-children page_item_has_children">
                                            <a href="javascript:void(0);">
                                                <span>Insights</span>
                                            </a>
                                            <ul class="sub-menu children">
                                                <li><a href="dashboard-insights.html">Insights</a></li>
                                                <li><a href="dashboard-insightsuser.html">Insights User</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboard-profile.html">
                                                <span>My Profile</span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">
                                                <span>All Jobs</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="dashboard-completejobs.html">Completed Jobs</a></li>
                                                <li><a href="dashboard-canceljobs.html">Cancelled Jobs</a></li>
                                                <li><a href="dashboard-ongoingjob.html">Ongoing Jobs</a></li>
                                                <li><a href="dashboard-ongoingsingle.html">Ongoing Single</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboard-managejobs.html">
                                                <span>Manage Jobs</span>
                                            </a>
                                        </li>
                                        <li class="wt-notificationicon menu-item-has-children">
                                            <a href="javascript:void(0);">
                                                <span>Messages</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="dashboard-messages.html">Messages</a></li>
                                                <li><a href="dashboard-messages2.html">Messages V 2</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboard-saveitems.html">
                                                <span>My Saved Items</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-invocies.html">
                                                <span>Invoices</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-category.html">
                                                <span>Category</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-packages.html">
                                                <span>Packages</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-proposals.html">
                                                <span>Proposals</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-accountsettings.html">
                                                <span>Account Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-helpsupport.html">
                                                <span>Help &amp; Support</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav> --}}
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>