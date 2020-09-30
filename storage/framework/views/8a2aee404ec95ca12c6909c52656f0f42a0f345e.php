<header id="wt-header" class="wt-header wt-headereleven">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if(!empty($logo) || Schema::hasTable('site_managements')): ?>
                        <strong class="wt-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset($logo)); ?>" alt="<?php echo e(trans('Logo')); ?>"></a></strong>
                    <?php endif; ?>
                    <div class="wt-rightarea">
                        <?php if(file_exists(resource_path('views/extend/includes/menu.blade.php'))): ?> 
                            <?php echo $__env->make('extend.includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?> 
                            <?php echo $__env->make('includes.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                        <?php if(auth()->guard()->guest()): ?>
                            <div class="wt-loginarea">
                                <div class="wt-loginoption wt-loginoptionvtwo">
                                    <a href="javascript:void(0);" id="wt-loginbtn" class="wt-btn"><?php echo e(trans('lang.sign_in')); ?></a>
                                    <div class="wt-loginformhold">
                                        <div class="wt-loginheader">
                                            <span><?php echo e(trans('lang.sign_in')); ?></span>
                                            <a href="javascript:;"><i class="fa fa-times"></i></a>
                                        </div>
                                        <form method="POST" action="<?php echo e(route('login')); ?>"class="wt-formtheme wt-loginform do-login-form">
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
                                                    <button href="javascript:;"  type="submit" class="wt-btn do-login-button"><?php echo e(trans('lang.sign_in')); ?></button>
                                                    <span class="wt-checkbox">
                                                        <input id="remember" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                        <label for="remember"><?php echo e(trans('lang.keep_me_logged_in')); ?></label>
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
                </div>
            </div>
        </div>
    </div>
    <div class="wt-categoriesnav-holder">
        <div class="container-fluid">
            <div class="row">
                <nav class="wt-categories-nav navbar-expand-xl">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#catnavbarNav" aria-controls="catnavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="lnr lnr-menu"></i>
                    </button>
                    <div class="collapse navbar-collapse wt-categories-navbar" id="catnavbarNav">
                        <ul>
                            <?php if(!empty($categories)): ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <?php if ($index == 7) break; ?>   
                                    <li>
                                        <a href="<?php echo e(url('search-results?type=job&category%5B%5D='.$cat['slug'])); ?>"><?php echo e($cat['title']); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($categories) > 7): ?>
                                    <li class="wt-catnav-children">
                                        <a href="javascript:void(0);"><?php echo e(trans('lang.see_all_cats')); ?></a>
                                        <ul class="wt-catnav-submenu">
                                            <?php $__currentLoopData = array_slice($categories, 7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <li>
                                                    <a href="<?php echo e(url('search-results?type=job&category%5B%5D='.$cat['slug'])); ?>"><?php echo e($cat['title']); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>