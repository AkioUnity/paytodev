<div class="wt-proposalsr">
    <div class="tg-authorcodescan">
        <figure class="tg-qrcodeimg">
            <?php echo QrCode::size(100)->generate(Request::url('service/'.$service->slug));; ?>

        </figure>
        <div class="tg-qrcodedetail">
            <span class="lnr lnr-laptop-phone"></span>
            <div class="tg-qrcodefeat">
                <h3><?php echo e(trans('lang.scan_with_smartphone')); ?> <span><?php echo e(trans('lang.smartphone')); ?> </span> <?php echo e(trans('lang.get_handy')); ?></h3>
            </div>
        </div>
    </div>
    <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/addtofavourite.blade.php'))): ?> 
        <?php echo $__env->make('extend.front-end.services.sidebar.addtofavourite', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.services.sidebar.addtofavourite', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</div>
