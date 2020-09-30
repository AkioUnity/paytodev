<div class="wt-widget la-empinfo-holder wt-user-service">
    <div class="wt-companysdetails">
        <figure class="wt-companysimg">
            <img src="<?php echo e(asset(Helper::getUserProfileBanner($seller->id, 'small'))); ?>" alt="<?php echo e(trans('lang.profile_img')); ?>">
        </figure>
        <div class="wt-companysinfo">
            <figure><img src="<?php echo e(asset(Helper::getProfileImage($seller->id))); ?>" alt="<?php echo e(trans('lang.profile_img')); ?>"></figure>
            <div class="wt-userprofile">
                <div class="wt-title">
                    <h3>			
                        <a href="<?php echo e(url('profile/'.$seller->slug)); ?>">
                            <?php if($seller->user_verified === 1): ?> <i class="fa fa-check-circle"></i> <?php endif; ?> &nbsp;<?php echo e(Helper::getUserName($seller->id)); ?>

                        </a>
                    </h3>
                    <?php echo e(trans('lang.member_since')); ?>&nbsp;<?php echo e(\Carbon\Carbon::parse($seller->created_at)->format('Y-m-d')); ?>	<a href="javascript:;">@ <?php echo e($seller->slug); ?></a> 
                    <a href="<?php echo e(url('profile/'.$seller->slug)); ?>" class="wt-btn">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
