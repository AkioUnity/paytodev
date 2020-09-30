<?php if(Schema::hasTable('users')): ?>
    <?php
    $inner_header = '';
    ?>
    <?php if(Schema::hasTable('pages') || Schema::hasTable('site_managements')): ?>
        <?php
            $settings = array();
            $pages = App\Page::all();
            $setting = \App\SiteManagement::getMetaValue('settings');
            $page_id='';
            $page_header= !empty($setting[0]['header_style']) ? $setting[0]['header_style'] : '';
            $page_header_styling='';
            $default_header_styling = \App\SiteManagement::getMetaValue('menu_settings');
            $menu_color = !empty($default_header_styling) && !empty($default_header_styling['menu_color']) ? $default_header_styling['menu_color'] : '';
            $menu_hover_color = !empty($default_header_styling) && !empty($default_header_styling['menu_hover_color']) ? $default_header_styling['menu_hover_color'] : '';
            $color = !empty($default_header_styling) && !empty($default_header_styling['color']) ? $default_header_styling['color'] : '';
            $page_order = !empty($default_header_styling) && !empty($default_header_styling['pages']) ? $default_header_styling['pages'] : array();
            $logo = !empty($setting[0]['logo']) ? Helper::getHeaderLogo($setting[0]['logo']) : '/images/logo.png';
            $inner_header = !empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' ? 'wt-headervtwo' : '';
            $type = Helper::getAccessType();
            if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home') {
                if (Request::segment(1) == 'page') {
                    $selected_page_data = APP\Page::getPageData(Request::segment(2));
                    $selected_page = !empty($selected_page_data) ? APP\Page::find($selected_page_data->id) : '';
                    $page_id = !empty($selected_page) ? $selected_page->id : '';
                    $slider = Helper::getPageSlider($page_id);
                    $page_header = Helper::getPageHeader($page_id);
                    $page_header_styling = !empty($selected_page) && !empty($selected_page->metaValue('header_styling')) 
                                            ? Helper::getUnserializeData($selected_page->metaValue('header_styling')['meta_value']) 
                                            :'';
                    $selected_logo = !empty($page_header_styling) && !empty($page_header_styling['logo']) ? 'uploads/pages/'.$page_id .'/'.$page_header_styling['logo'] : '';
                    $selected_menu_color = !empty($page_header_styling) && !empty($page_header_styling['menuColor']) ? $page_header_styling['menuColor'] : '';
                    $selected_menu_hover_color = !empty($page_header_styling) && !empty($page_header_styling['menuHoverColor']) ? $page_header_styling['menuHoverColor'] : '';    
                    $selected_color =  !empty($page_header_styling) && !empty($page_header_styling['color']) ? $page_header_styling['color'] : '';  
                } elseif (Request::segment(1) == 'search-results') {
                    $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                    if (!empty($_GET['type'])) {
                        if ($_GET['type'] == 'freelancer') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['freelancer_header_styling']) ? $inner_page[0]['freelancer_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['f_menu_color']) ? $inner_page[0]['f_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['f_hover_color']) ? $inner_page[0]['f_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['f_menu_text_color']) ? $inner_page[0]['f_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['f_logo']) ? 'uploads/settings/general/'.$inner_page[0]['f_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['f_header_style']) ? $inner_page[0]['f_header_style'] : '';
                        } elseif ($_GET['type'] == 'employer') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['employer_header_styling']) ? $inner_page[0]['employer_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['e_menu_color']) ? $inner_page[0]['e_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['e_hover_color']) ? $inner_page[0]['e_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['e_menu_text_color']) ? $inner_page[0]['e_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['e_logo']) ? 'uploads/settings/general/'.$inner_page[0]['e_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['emp_header_style']) ? $inner_page[0]['emp_header_style'] : '';
                        } elseif ($_GET['type'] == 'job') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['job_header_styling']) ? $inner_page[0]['job_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['job_menu_color']) ? $inner_page[0]['job_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['job_hover_color']) ? $inner_page[0]['job_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['job_menu_text_color']) ? $inner_page[0]['job_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['job_logo']) ? 'uploads/settings/general/'.$inner_page[0]['job_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['job_header_style']) ? $inner_page[0]['job_header_style'] : '';
                        } elseif ($_GET['type'] == 'service') {
                            $header_styling = !empty($inner_page) && !empty($inner_page[0]['service_header_styling']) ? $inner_page[0]['service_header_styling'] : 'false';
                            if ($header_styling == 'true') {
                                $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['service_menu_color']) ? $inner_page[0]['service_menu_color'] : '';
                                $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['service_hover_color']) ? $inner_page[0]['service_hover_color'] : '';    
                                $selected_color = !empty($inner_page) && !empty($inner_page[0]['service_menu_text_color']) ? $inner_page[0]['service_menu_text_color'] : '';  
                                $selected_logo = !empty($inner_page) && !empty($inner_page[0]['service_logo']) ? 'uploads/settings/general/'.$inner_page[0]['service_logo'] : '';  
                            }
                            $page_header = !empty($inner_page) && !empty($inner_page[0]['service_header_style']) ? $inner_page[0]['service_header_style'] : '';
                        }
                    }
                } elseif (Request::segment(1) == 'articles') {
                    $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                    $header_styling = !empty($inner_page) && !empty($inner_page[0]['article_header_styling']) ? $inner_page[0]['article_header_styling'] : 'false';
                    if ($header_styling == 'true') {
                        $selected_menu_color = !empty($inner_page) && !empty($inner_page[0]['article_menu_color']) ? $inner_page[0]['article_menu_color'] : '';
                        $selected_menu_hover_color = !empty($inner_page) && !empty($inner_page[0]['article_hover_color']) ? $inner_page[0]['article_hover_color'] : '';    
                        $selected_color = !empty($inner_page) && !empty($inner_page[0]['article_menu_text_color']) ? $inner_page[0]['article_menu_text_color'] : '';  
                        $selected_logo = !empty($inner_page) && !empty($inner_page[0]['article_logo']) ? 'uploads/settings/general/'.$inner_page[0]['article_logo'] : '';  
                    }
                    $page_header = !empty($inner_page) && !empty($inner_page[0]['article_header_style']) ? $inner_page[0]['article_header_style'] : '';
                }
            } else {
                $page_id = APP\SiteManagement::getMetaValue('homepage')['home'];
                $slider = Helper::getPageSlider($page_id);
                $page_header = Helper::getPageHeader($page_id);
            }
            //$selected_header = !empty($setting[0]['header_style']) ? $setting[0]['header_style'] : '';
            if ($page_header == 'style5') {
                $categories = App\Category::all()->toArray();
            }
        ?>
    <?php endif; ?>
    <?php
        $logo =  !empty($selected_logo) ? $selected_logo : $logo;
        $menu_color =  !empty($selected_menu_color) ? $selected_menu_color : $menu_color;
        $menu_hover_color =  !empty($selected_menu_hover_color) ? $selected_menu_hover_color : $menu_hover_color;
        $color =  !empty($selected_color) ? $selected_color : $color;
    ?>
    <?php $__env->startPush('stylesheets'); ?>
        <style>
            .wt-header .wt-navigation>ul>.menu-item-has-children:after,
            .wt-header .wt-navigation > ul > li > a {
                color: <?php echo e($menu_color); ?>;
            }
            .wt-navigation > ul > li.current-menu-item > a,
            .wt-navigation ul li .sub-menu > li:hover > a,
            .wt-navigation > ul > li:hover > a{
                color: <?php echo e($menu_hover_color); ?>;
            }
            .wt-header .wt-navigationarea .wt-navigation > ul > li > a:after{
                background: <?php echo e($menu_hover_color); ?>;
            }
            .wt-header .wt-navigationarea .wt-userlogedin .wt-username span,
            .wt-header .wt-navigationarea .wt-userlogedin .wt-username h3 {color: <?php echo e($color); ?> };
        </style>
    <?php $__env->stopPush(); ?>
    <?php if(!empty($page_header)): ?>
        <?php if($page_header == 'style1'): ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header1', ['page_order' => $page_order], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header1', ['page_order' => $page_order], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php elseif($page_header == 'style2'): ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header2.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header2', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header2', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php elseif($page_header == 'style3'): ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header3.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header3', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header3', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php elseif($page_header == 'style4'): ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header4.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header4', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header4', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>  
        <?php elseif($page_header == 'style5'): ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header5.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header5', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header5', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>      
        <?php endif; ?>
    <?php elseif(!empty($slider) && $slider['index'] == 0): ?> 
        <?php if(!empty($slider['style']) && $slider['style'] == 'style3'): ?>
            <header id="wt-header" class="wt-header wt-headervfour wt-haslayout">
                <div class="wt-navigationarea">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?php if(!empty($logo) || Schema::hasTable('site_managements')): ?>
                                    <strong class="wt-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset($logo)); ?>" alt="<?php echo e(trans('Logo')); ?>"></a></strong>
                                <?php endif; ?>
                                <div class="wt-rightarea">
                                    <?php if(auth()->guard()->guest()): ?>
                                        <div class="wt-loginarea">
                                            <div class="wt-loginoption">
                                                <a href="javascript:void(0);" id="wt-loginbtn" class="wt-loginbtn"><?php echo e(trans('lang.login')); ?></a>
                                                <div class="wt-loginformhold" <?php if($errors->has('email') || $errors->has('password')): ?> style="display: block;" <?php endif; ?>>
                                                    <div class="wt-loginheader">
                                                        <span><?php echo e(trans('lang.login')); ?></span>
                                                        <a href="javascript:;"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    <form method="POST" action="<?php echo e(route('login')); ?>" class="wt-formtheme wt-loginform do-login-form">
                                                        <?php echo csrf_field(); ?>
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <input id="email" type="email" name="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                                                    placeholder="Email" required autofocus>
                                                                <?php if($errors->has('email')): ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <input id="password" type="password" name="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                                    placeholder="Password" required>
                                                                <?php if($errors->has('password')): ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="wt-logininfo">
                                                                    <button type="submit" class="wt-btn do-login-button"><?php echo e(trans('lang.login')); ?></button>
                                                                <span class="wt-checkbox">
                                                                    <input id="remember" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                                    <label for="remember"><?php echo e(trans('lang.remember')); ?></label>
                                                                </span>
                                                            </div>
                                                        </fieldset>
                                                        <div class="wt-loginfooterinfo">
                                                            <?php if(Route::has('password.request')): ?>
                                                                <a href="<?php echo e(route('password.request')); ?>" class="wt-forgot-password"><?php echo e(trans('lang.forget_pass')); ?></a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(route('register')); ?>"><?php echo e(trans('lang.create_account')); ?></a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a href="<?php echo e(route('register')); ?>" class="wt-btn"><?php echo e(trans('lang.join_now')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php
                                            $user = !empty(Auth::user()) ? Auth::user() : '';
                                            $role = !empty($user) ? $user->getRoleNames()->first() : array();
                                            $profile = \App\User::find(Auth::user()->id)->profile;
                                            $user_image = !empty($profile) ? $profile->avater : '';
                                            $employer_job = \App\Job::select('status')->where('user_id', Auth::user()->id)->first();
                                            $profile_image = !empty($user_image) ? '/uploads/users/'.$user->id.'/'.$user_image : 'images/user-login.png';
                                            $payment_settings = \App\SiteManagement::getMetaValue('commision');
                                            $payment_module = !empty($payment_settings) && !empty($payment_settings[0]['enable_packages']) ? $payment_settings[0]['enable_packages'] : 'true';
                                            $employer_payment_module = !empty($payment_settings) && !empty($payment_settings[0]['employer_package']) ? $payment_settings[0]['employer_package'] : 'true';
                                        ?>
                                        <div class="wt-userlogedin">
                                            <figure class="wt-userimg">
                                                <img src="<?php echo e(asset(Helper::getImage('uploads/users/' . Auth::user()->id, $profile->avater, '' , 'user.jpg'))); ?>" alt="<?php echo e(trans('lang.user_avatar')); ?>">
                                            </figure>
                                            <div class="wt-username">
                                                <h3><?php echo e(Helper::getUserName(Auth::user()->id)); ?></h3>
                                                <span><?php echo e(!empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Helper::getAuthRoleName()); ?></span>
                                            </div>
                                            <?php if(file_exists(resource_path('views/extend/back-end/includes/profile-menu.blade.php'))): ?> 
                                                <?php echo $__env->make('extend.back-end.includes.profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            <?php else: ?> 
                                                <?php echo $__env->make('back-end.includes.profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(file_exists(resource_path('views/extend/includes/menu.blade.php'))): ?> 
                                    <?php echo $__env->make('extend.includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?> 
                                    <?php echo $__env->make('includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <?php else: ?>
            <?php if(file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))): ?> 
                <?php echo $__env->make('extend.includes.headers.header1', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('includes.headers.header1', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(file_exists(resource_path('views/extend/includes/headers/header1.blade.php'))): ?> 
            <?php echo $__env->make('extend.includes.headers.header1', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('includes.headers.header1', ['styling' => $page_header_styling], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

