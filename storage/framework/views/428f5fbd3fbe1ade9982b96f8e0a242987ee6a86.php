
<?php $__env->startPush('stylesheets'); ?>
    <link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?><?php echo e($service->title); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description', "$service->description"); ?>
<?php $__env->startSection('content'); ?>
    <?php $breadcrumbs = Breadcrumbs::generate('serviceDetail', $service->slug); ?>
    <?php if(file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.service_detail'), 'inner_banner' => '', 'show_banner' => 'true'  ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.service_detail'), 'inner_banner' => '', 'show_banner' => 'true'  ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <div class="wt-haslayout wt-main-section" id="services">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                        <div class="wt-usersingle wt-servicesingle-holder">
                            <div class="wt-servicesingle">
                                <?php if($service->is_featured == 'true'): ?>
                                    <span class="wt-featuredtagvtwo"><?php echo e(trans('lang.featured')); ?></span>
                                <?php endif; ?>
                                
                                <div class="wt-servicesingle-title">
                                    <div class="wt-title">
                                        <?php if(!empty($service->title)): ?>
                                            <h2><?php echo e($service->title); ?></h2>
                                        <?php endif; ?>
                                    </div>
                                    <ul class="wt-userlisting-breadcrumb">
                                        <li>
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <?php echo e($rating); ?>/<i>5</i>&nbsp;(<?php echo e(!empty($reviews) ? $reviews->count() : ''); ?> <?php echo e(trans('lang.feedbacks')); ?>)
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <?php if($total_orders > 0): ?>
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                <?php endif; ?>
                                                <?php echo e($total_orders); ?> <?php echo e(trans('lang.in_queue')); ?>

                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <?php if(!empty($attachments)): ?>
                                    <?php $enable_slider = count($attachments) > 1 ? 'wt-servicesslider' : ''; ?>
                                    <div class="wt-freelancers-info">
                                        <div id="<?php echo e($enable_slider); ?>" class="wt-servicesslider owl-carousel">
                                            <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <figure class="item">
                                                    <img src="<?php echo e(asset(Helper::getImageWithSize('uploads/services/'.$seller->id, $attachment, 'medium'))); ?>" alt="img description" class="item">
                                                </figure>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php if(count($attachments) > 1): ?>
                                            <div id="wt-servicesgallery" class="wt-servicesgallery owl-carousel">
                                                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $image = 'uploads/services/'.$seller->id.'/'.$attachment; ?>
                                                    <div class="item"><figure><img src="<?php echo e(asset($image)); ?>" alt="img description"></figure></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="wt-service-details">
                                    <?php if(!empty($service->description)): ?>
                                        <div class="wt-description">
                                            <?php echo htmlspecialchars_decode(stripslashes($service->description)); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="wt-clientfeedback">
                                <div class="wt-usertitle wt-titlewithselect">
                                    <h2><?php echo e(trans('lang.reviews')); ?></h2>
                                </div>
                                <?php if(!empty($reviews) && $reviews->count() != 0): ?>
                                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $user = App\User::find($review->user_id);
                                            $stars  = $review->avg_rating != 0 ? $review->avg_rating/5*100 : 0;
                                        ?>
                                        <div class="wt-userlistinghold wt-userlistingsingle">
                                                <figure class="wt-userlistingimg">
                                                    <img src="<?php echo e(asset(Helper::getProfileImage($review->user_id))); ?>" alt="<?php echo e(trans('Employer')); ?>">
                                                </figure>
                                                <div class="wt-userlistingcontent">
                                                    <div class="wt-contenthead">
                                                        <div class="wt-title">
                                                            <a href="<?php echo e(url('profile/'.$user->slug)); ?>"><?php if($user->user_verified == 1): ?><i class="fa fa-check-circle"></i><?php endif; ?> <?php echo e(Helper::getUserName($review->user_id)); ?></a>
                                                            <h3><?php echo e($service->title); ?></h3>
                                                        </div>
                                                        <ul class="wt-userlisting-breadcrumb">
                                                            <?php if(!empty($service->location)): ?>
                                                                <li>
                                                                    <span>
                                                                        <img src="<?php echo e(asset(Helper::getLocationFlag($service->location->flag))); ?>" alt="<?php echo e(trans('lang.flag_img')); ?>"> <?php echo e($service->location->title); ?>

                                                                    </span>
                                                                </li>
                                                            <?php endif; ?>
                                                            <li><span><i class="far fa-calendar"></i> <?php echo e(Carbon\Carbon::parse($service->created_at)->format('M Y')); ?> - <?php echo e(Carbon\Carbon::parse($service->updated_at)->format('M Y')); ?></span></li>
                                                            <li>
                                                                <span class="wt-stars"><span style="width: <?php echo e($stars); ?>%;"></span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="wt-description">
                                                    <?php if(!empty($review->feedback)): ?>
                                                        <p>“ <?php echo e($review->feedback); ?> ”</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="wt-userprofile">
                                        <?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?>
                                            <?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php else: ?>
                                            <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                        <?php if(file_exists(resource_path('views/extend/front-end/services/sidebar/index.blade.php'))): ?>
                            <?php echo $__env->make('extend.front-end.services.sidebar.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('front-end.services.sidebar.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script>
        /* SERVICE SLIDER */
        function customerFeedback(){
            var sync1 = jQuery('#wt-servicesslider');
            var sync2 = jQuery('#wt-servicesgallery');
            var slidesPerPage = 3;
            var syncedSecondary = true;
            sync1.owlCarousel({
                items : 1,
                loop: true,
                nav: false,
                dots: false,
                autoplay: false,
                slideSpeed : 2000,
                navClass: ['wt-prev', 'wt-next'],
                navContainerClass: 'wt-search-slider-nav',
                navText: ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'],
                responsiveRefreshRate : 200,
            }).on('changed.owl.carousel', syncPosition);

            sync2.on('initialized.owl.carousel', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            })

            .owlCarousel({
                // items : slidesPerPage,
                items:8,
                dots: false,
                nav: false,
                margin:10,
                smartSpeed: 200,
                slideSpeed : 500,
                slideBy: slidesPerPage,
                responsiveRefreshRate : 100,
            }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                var count = el.item.count-1;
                var current = Math.round(el.item.index - (el.item.count/2) - .5);
                if(current < 0) {
                    current = count;
                }
                if(current > count) {
                    current = 0;
                }
                sync2.find(".owl-item").removeClass("current").eq(current).addClass("current")
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();
                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }
            function syncPosition2(el) {
                if(syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }
            sync2.on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = jQuery(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        }
        customerFeedback();
        var popupMeta = {
            width: 400,
            height: 400
        }
        $(document).on('click', '.social-share', function(event){
            event.preventDefault();

            var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
                hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

            var url = $(this).attr('href');
            var popup = window.open(url, 'Social Share',
                'width='+popupMeta.width+',height='+popupMeta.height+
                ',left='+vPosition+',top='+hPosition+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                return false;
            }
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ?
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>