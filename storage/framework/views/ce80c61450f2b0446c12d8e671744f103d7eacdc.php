<nav id="wt-profiledashboard" class="wt-usernav">
        <ul>
            <?php if($role === 'admin'): ?>
                
                    
                    
                        
                        
                    
                    
                        
                        
                    
                
                
                    
                        
                        
                    
                
                
                    
                        
                        
                    
                
                <?php if(Helper::getAccessType() == 'both' || Helper::getAccessType() == 'jobs'): ?>
                    <li>
                        <a href="<?php echo e(route('allJobs')); ?>">
                            <i class="ti-briefcase"></i>
                            <span><?php echo e(trans('lang.all_jobs')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Helper::getAccessType() == 'both' || Helper::getAccessType() == 'services'): ?>
                    <li>
                        <a href="<?php echo e(route('allServices')); ?>">
                            <i class="ti-briefcase"></i>
                            <span><?php echo e(trans('lang.services')); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('ServiceOrders')); ?>">
                            <i class="ti-briefcase"></i>
                            <span><?php echo e(trans('lang.service_orders')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo e(route('reviewOptions')); ?>">
                        <i class="ti-check-box"></i>
                        <span><?php echo e(trans('lang.review_options')); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('userListing')); ?>">
                        <i class="ti-user"></i>
                        <span><?php echo e(trans('lang.manage_users')); ?></span>
                    </a>
                </li>
                
                    
                        
                        
                    
                
                
                    
                    
                        
                        
                    
                    
                        
                        
                    
                
                
                    
                        
                        
                    
                
                <li>
                    <a href="<?php echo e(route('adminPayouts')); ?>">
                        <i class="ti-money"></i>
                        <span><?php echo e(trans('lang.payouts')); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('homePageSettings')); ?>">
                        <i class="ti-home"></i>
                        <span><?php echo e(trans('lang.home_page_settings')); ?></span>
                    </a>
                </li>
                
                    
                    
                        
                        
                    
                    
                        
                        
                        
                    
                
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="ti-layers"></i></span>
                    <a href="<?php echo e(route('categories')); ?>">
                        <i class="ti-layers"></i>
                        <span><?php echo e(trans('lang.taxonomies')); ?></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo e(route('skills')); ?>"><?php echo e(trans('lang.skills')); ?></a></li>
                        <li><a href="<?php echo e(route('categories')); ?>"><?php echo e(trans('lang.job_cats')); ?></a></li>
                        
                        <li><a href="<?php echo e(route('languages')); ?>"><?php echo e(trans('lang.langs')); ?></a></li>
                        <li><a href="<?php echo e(route('locations')); ?>"><?php echo e(trans('lang.locations')); ?></a></li>
                        
                        
                        
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($role === 'employer' || $role === 'freelancer' ): ?>
                <li>
                    <a href="<?php echo e(url($role.'/dashboard')); ?>">
                        <i class="ti-desktop"></i>
                        <span><?php echo e(trans('lang.dashboard')); ?></span>
                    </a>
                </li>
                
                    
                        
                        
                    
                
                <li>
                    <a href="<?php echo e(route('message')); ?>">
                        <i class="ti-envelope"></i>
                        <span><?php echo e(trans('lang.msg_center')); ?></span>
                    </a>
                </li>
                
                    
                    
                        
                        
                    
                    
                        
                        
                    
                
                <?php if($role === 'employer'): ?>
                    <?php if(Helper::getAccessType() == 'both' || Helper::getAccessType() == 'jobs'): ?>
                        <li>
                            <a href="<?php echo e(route('employerPostJob')); ?>">
                                <i class="ti-pencil-alt"></i>
                                <span><?php echo e(trans('lang.post_job')); ?></span>
                            </a>
                        </li>
                        <li class="menu-item-has-children page_item_has_children">
                            <a href="javascript:void(0);">
                                <i class="ti-announcement"></i>
                                <span><?php echo e(trans('lang.jobs')); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo e(route('employerManageJobs')); ?>"><?php echo e(trans('lang.manage_job')); ?></a></li>
                                <li><a href="<?php echo e(url('employer/jobs/completed')); ?>"><?php echo e(trans('lang.completed_projects')); ?></a></li>
                                <li><a href="<?php echo e(url('employer/jobs/hired')); ?>"><?php echo e(trans('lang.ongoing_projects')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(Helper::getAccessType() == 'both' || Helper::getAccessType() == 'services'): ?>
                        <li class="menu-item-has-children">
                            <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                            <a href="javascript:void(0)">
                                <i class="ti-briefcase"></i>
                                <span><?php echo e(trans('lang.manage_services')); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo e(url('employer/services/hired')); ?>"><?php echo e(trans('lang.ongoing_services')); ?></a></li>
                                <li><a href="<?php echo e(url('employer/services/completed')); ?>"><?php echo e(trans('lang.completed_services')); ?></a></li>
                                <li><a href="<?php echo e(url('employer/services/cancelled')); ?>"><?php echo e(trans('lang.cancelled_services')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                        
                            
                            
                        
                    
                    
                        
                            
                            
                        
                        
                            
                                
                            
                            
                        
                    
                    
                        
                            
                                
                                
                            
                        
                    
                <?php elseif($role === 'freelancer'): ?>
                        
                            
                                
                                
                            
                        
                    <li class="menu-item-has-children page_item_has_children">
                        <a href="javascript:void(0)">
                            <i class="ti-briefcase"></i>
                            <span><?php echo e(trans('lang.all_projects')); ?></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo e(url('freelancer/jobs/completed')); ?>"><?php echo e(trans('lang.completed_projects')); ?></a></li>
                            <li><a href="<?php echo e(url('freelancer/jobs/cancelled')); ?>"><?php echo e(trans('lang.cancelled_projects')); ?></a></li>
                            <li><a href="<?php echo e(url('freelancer/jobs/hired')); ?>"><?php echo e(trans('lang.ongoing_projects')); ?></a></li>
                        </ul>
                    </li>
                    <?php if(Helper::getAccessType() == 'both' || Helper::getAccessType() == 'services'): ?>
                        <li class="menu-item-has-children">
                            <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                            <a href="javascript:void(0)">
                                <i class="ti-briefcase"></i>
                                <span><?php echo e(trans('lang.manage_services')); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo e(route('ServiceListing', ['status'=>'posted'])); ?>"><?php echo e(trans('lang.posted_services')); ?></a></li>
                                <li><a href="<?php echo e(route('ServiceListing', ['status'=>'hired'])); ?>"><?php echo e(trans('lang.ongoing_services')); ?></a></li>
                                <li><a href="<?php echo e(route('ServiceListing', ['status'=>'completed'])); ?>"><?php echo e(trans('lang.completed_services')); ?></a></li>
                                <li><a href="<?php echo e(route('ServiceListing', ['status'=>'cancelled'])); ?>"><?php echo e(trans('lang.cancelled_services')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                        
                            
                            
                        
                    
                    
                        
                            
                            
                        
                    
                    
                        
                            
                                
                                
                            
                            
                                    
                            
                        
                        
                            
                                
                                
                            
                        
                    
                <?php endif; ?>
                
                    
                        
                        
                    
                
            <?php endif; ?>
            <li>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
                    <i class="lnr lnr-exit"></i>
                    <?php echo e(trans('lang.logout')); ?>

                </a>
                <form id="profile-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        </ul>
    </nav>
