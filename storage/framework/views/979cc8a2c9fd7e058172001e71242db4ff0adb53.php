<aside id="wt-sidebar" class="wt-sidebar">
    <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/service_info.blade.php'))): ?> 
        <?php echo $__env->make('extend.front-end.services.sidebar.service_info', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.services.sidebar.service_info', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($seller)): ?>
        <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/user_info.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.services.sidebar.user_info', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.services.sidebar.user_info', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/qrcode.blade.php'))): ?> 
        <?php echo $__env->make('extend.front-end.services.sidebar.qrcode', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.services.sidebar.qrcode', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/social-share.blade.php'))): ?> 
        <?php echo $__env->make('extend.front-end.services.sidebar.social-share', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.services.sidebar.social-share', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/report.blade.php'))): ?> 
        <?php echo $__env->make('extend.front-end.services.sidebar.report', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.services.sidebar.report', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</aside>
