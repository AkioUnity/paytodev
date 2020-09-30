
<?php $__env->startPush('stylesheets'); ?>
    <link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?><?php echo e($service_list_meta_title); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description', $service_list_meta_desc); ?>
<?php $__env->startSection('content'); ?>
    <?php $breadcrumbs = Breadcrumbs::generate('searchResults'); ?>
    <?php if(file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.services'), 'inner_banner' => $service_inner_banner, 'show_banner' => $show_service_banner ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.services'), 'inner_banner' => $service_inner_banner, 'show_banner' => $show_service_banner ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <div class="wt-haslayout wt-main-section" id="services">
        <?php if(Session::has('payment_message')): ?>
            <?php $response = Session::get('payment_message') ?>
            <div class="flash_msg">
                <flash_messages :message_class="'<?php echo e($response['code']); ?>'" :time ='5' :message="'<?php echo e($response['message']); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            <?php if(file_exists(resource_path('views/extend/front-end/services/filters.blade.php'))): ?> 
                                <?php echo $__env->make('extend.front-end.services.filters', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?> 
                                <?php echo $__env->make('front-end.services.filters', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="row">
                                <div class="wt-freelancers-holder la-freelancers-grid">
                                    <?php if(!empty($keyword)): ?>
                                        <div class="wt-userlistingtitle">
                                            <span><?php echo e(trans('lang.01')); ?> <?php echo e($services->count()); ?> of <?php echo e($services_total_records); ?> results for <em>"<?php echo e($keyword); ?>"</em></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($services) && $services->count() > 0): ?>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $service_reviews = $service->seller->count() > 0 ? Helper::getServiceReviews($service->seller[0]->id, $service->id) : ''; 
                                                $service_rating=0;
                                                if(!empty($service_reviews)) {
                                                    $service_rating = $service_reviews->sum('avg_rating') != 0 ? round($service_reviews->sum('avg_rating') / $service_reviews->count()) : 0;
                                                }
                                                $attachments = Helper::getUnserializeData($service->attachments);
                                                $no_attachments = empty($attachments) ? 'la-service-info' : '';
                                                $enable_slider = !empty($attachments) ? 'wt-servicesslider' : '';
                                                $total_orders = Helper::getServiceCount($service->id, 'hired');
                                            ?>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                                                <div class="wt-freelancers-info <?php echo e($no_attachments); ?>">
                                                    <?php if($service->seller->count() > 0): ?>
                                                        <?php if(!empty($attachments)): ?>
                                                            <?php $enable_slider = count($attachments) > 1 ? 'wt-freelancerslider owl-carousel' : ''; ?>
                                                            <div class="wt-freelancers <?php echo e($enable_slider); ?>">
                                                                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <figure class="item">
                                                                        <a href="<?php echo e(url('profile/'.$service->seller[0]->slug)); ?>"><img src="<?php echo e(asset(Helper::getImageWithSize('uploads/services/'.$service->seller[0]->id, $attachment, 'medium'))); ?>" alt="img description" class="item"></a>
                                                                    </figure>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if($service->is_featured == 'true'): ?>
                                                        <span class="wt-featuredtagvtwo"><?php echo e(trans('lang.featured')); ?></span>
                                                    <?php endif; ?>
                                                    <div class="wt-freelancers-details">
                                                        <?php if($service->seller->count() > 0): ?>
                                                            <figure class="wt-freelancers-img">
                                                                <img src="<?php echo e(asset(Helper::getProfileImage($service->seller[0]->id))); ?>" alt="img description">
                                                            </figure>
                                                        <?php endif; ?>
                                                        <div class="wt-freelancers-content">
                                                            <div class="dc-title">
                                                                <?php if($service->seller->count() > 0): ?>
                                                                    <a href="<?php echo e(url('profile/'.$service->seller[0]->slug)); ?>"><i class="fa fa-check-circle"></i> <?php echo e(Helper::getUserName($service->seller[0]->id)); ?></a>
                                                                <?php endif; ?>
                                                                <a href="<?php echo e(url('service/'.$service->slug)); ?>"><h3><?php echo e($service->title); ?></h3></a>
                                                                <span><strong><?php echo e((!empty($symbol['symbol'])) ? $symbol['symbol'] : '$'); ?><?php echo e($service->price); ?></strong> <?php echo e(trans('lang.starting_from')); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="wt-freelancers-rating">
                                                            <ul>
                                                                <li><span><i class="fa fa-star"></i><?php echo e($service_rating); ?>/<i>5</i> (<?php echo e(!empty($service_reviews) ? $service_reviews->count() : ''); ?>)</span></li>
                                                                <li>
                                                                    <?php if($total_orders > 0): ?>
                                                                        <i class="fa fa-spinner fa-spin"></i>
                                                                    <?php endif; ?>
                                                                    <?php echo e($total_orders); ?> <?php echo e(trans('lang.in_queue')); ?>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if( method_exists($services,'links') ): ?>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                                                <?php echo e($services->links('pagination.custom')); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?> 
                                            <?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php else: ?> 
                                            <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script>
        var _wt_freelancerslider = jQuery('.wt-freelancerslider')
        _wt_freelancerslider.owlCarousel({
            items: 1,
            loop:true,
            nav:true,
            margin: 0,
            autoplay:false,
            navClass: ['wt-prev', 'wt-next'],
            navContainerClass: 'wt-search-slider-nav',
            navText: ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'],
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>