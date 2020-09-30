
<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="dashboard">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
            <?php session()->forget('message');  ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-insightsitemholder">
                    <div class="row">
                        
                            
                                
                                    
                                
                                
                                    
                                        
                                        
                                    
                                
                            
                        
                        
                            
                                
                                    
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    
                                
                            
                        
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox <?php echo e($notify_class); ?>">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_new_message_icon, 'book')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.new_msgs')); ?></h3>
                                        <a href="<?php echo e(route('message')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            
                                
                                    
                                
                                
                                    
                                        
                                        
                                    
                                
                            
                        
                        <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_cancel_project_icon, 'cross-circle')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalProposalsByStatus($freelancer_id, 'cancelled')); ?></h3>
                                            <h3><?php echo e(trans('lang.total_cancelled_projects')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/jobs/cancelled')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_ongoing_project_icon, 'cloud-sync')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalProposalsByStatus($freelancer_id, 'hired')); ?></h3>
                                            <h3><?php echo e(trans('lang.total_ongoing_projects')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/jobs/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                            
                                
                                    
                                
                                
                                    
                                        
                                        
                                    
                                
                            
                        
                        
                            
                                
                                    
                                
                                
                                    
                                    
                                        
                                    
                                
                            
                        
                        <?php if($access_type == 'services' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$ongoing_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalFreelancerServices('hired', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_ongoing_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$completed_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalFreelancerServices('completed', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_completed_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/completed')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$cancelled_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalFreelancerServices('cancelled', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_cancelled_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/cancelled')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$published_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalFreelancerServices('published', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_published_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/posted')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                <div class="wt-dashboardbox wt-ongoingproject la-ongoing-projects">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2><?php echo e(trans('lang.ongoing_project')); ?></h2>
                    </div>
                    <div class="wt-dashboardboxcontent wt-hiredfreelance">
                            <table class="wt-tablecategories wt-freelancer-table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.project_title')); ?></th>
                                        <th><?php echo e(trans('lang.employer_name')); ?></th>
                                        <th><?php echo e(trans('lang.project_cost')); ?></th>
                                        <th><?php echo e(trans('lang.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                                    <?php if(!empty($ongoing_projects) && $ongoing_projects->count() > 0): ?>
                                        <?php $__currentLoopData = $ongoing_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $project = \App\Proposal::find($projects->id);
                                                $user = \App\User::find($project->job->user_id);
                                                $user_name = Helper::getUsername($project->job->user_id);
                                            ?>
                                            <tr>
                                                <td data-th="Project title"><span class="bt-content"><a target="_blank" href="<?php echo e(url('freelancer/job/'.$project->job->slug)); ?>"><?php echo e(str_limit($project->job->title, 40)); ?></a></span></td>
                                                <td data-th="Hired freelancer">
                                                    <span class="bt-content"><a href="<?php echo e(url('profile/'.$user->slug)); ?>"><?php if($user->user_verified): ?><i class="fa fa-check-circle"></i>&nbsp;<?php endif; ?><?php echo e($user_name); ?></a>
                                                    </span>
                                                </td>
                                                <td data-th="Project cost"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($projects->amount); ?></span></td>
                                                <td data-th="Actions">
                                                    <span class="bt-content"><div class="wt-btnarea"><a href="<?php echo e(url('freelancer/job/'.$project->job->slug)); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a></div></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(($access_type == 'services' || $access_type == 'both') && (Schema::hasTable('services') && Schema::hasTable('service_user'))): ?>
                                    <?php if(Helper::getFreelancerServices('hired', Auth::user()->id)->count() > 0): ?>
                                        <?php $__currentLoopData = Helper::getFreelancerServices('hired', Auth::user()->id)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ongoing_service_key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $employer = \App\User::find($service->pivot_user);
                                                $user_name = Helper::getUsername($service->pivot_user);
                                            ?>
                                            <tr>
                                                <td data-th="Project title">
                                                    <span class="bt-content">
                                                        <a target="_blank" href="<?php echo e(url('freelancer/service/'.$service->pivot_id.'/hired')); ?>">
                                                            <?php echo e(str_limit($service->title, 40)); ?>

                                                        </a>
                                                    </span>
                                                </td>
                                                <td data-th="Hired freelancer">
                                                    <span class="bt-content">
                                                        <a href="<?php echo e(url('profile/'.$employer->slug)); ?>">
                                                            <?php if($employer->user_verified): ?>
                                                                <i class="fa fa-check-circle"></i>&nbsp;
                                                            <?php endif; ?>
                                                            <?php echo e($user_name); ?>

                                                        </a>
                                                    </span>
                                                </td>
                                                <td data-th="Project cost">
                                                    <span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($service->price); ?></span>
                                                </td>
                                                <td data-th="Actions">
                                                    <span class="bt-content">
                                                        <div class="wt-btnarea">
                                                            <a href="<?php echo e(url('freelancer/service/'.$service->pivot_id.'/hired')); ?>" class="wt-btn">
                                                                <?php echo e(trans('lang.view_detail')); ?>

                                                            </a>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                <div class="wt-dashboardbox  wt-ongoingproject la-ongoing-projects">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2><?php echo e(trans('lang.past_earnings')); ?></h2>
                    </div>
                    <?php
                        $pastearing_check = '';
                        if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
                            $pastearing_check = Helper::getFreelancerServices('completed', Auth::user()->id, 'completed')->count() > 0;
                        }
                    ?>
                    <?php if((!empty($completed_projects_history) && $completed_projects_history->count() > 0) || $pastearing_check): ?>
                        <?php
                            $commision = \App\SiteManagement::getMetaValue('commision');
                            $admin_commission = !empty($commision[0]['commision']) ? $commision[0]['commision'] : 0;
                        ?>
                        <div class="wt-dashboardboxcontent wt-hiredfreelance">
                            <table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.project_title')); ?></th>
                                        <th><?php echo e(trans('lang.date')); ?></th>
                                        <th><?php echo e(trans('lang.earnings')); ?></th>
                                    </tr>
                                </thead>
                                <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                                    <?php if(!empty($completed_projects_history) && $completed_projects_history->count() > 0): ?>
                                        <tbody>
                                            <?php $__currentLoopData = $completed_projects_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $project = \App\Proposal::find($projects->id);
                                                    $user_name = Helper::getUsername($project->job->user_id);
                                                    $amount = !empty($project->amount) ? $project->amount - ($project->amount / 100) * $admin_commission : 0;
                                                ?>
                                                <tr class="wt-earning-contents">
                                                    <td class="wt-earnig-single" data-th="Project Title"><span class="bt-content"><?php echo e($project->job->title); ?></span></td>
                                                    <td data-th="Date"><span class="bt-content"><?php echo e($project->updated_at); ?></span></td>
                                                    <td data-th="Earnings"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($amount); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($access_type == 'services' || $access_type == 'both'): ?>
                                    <?php if(Helper::getFreelancerServices('completed', Auth::user()->id)->count() > 0): ?>
                                        <tbody>
                                            <?php $__currentLoopData = Helper::getFreelancerServices('completed', Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $freelancer = Helper::getServiceSeller($service->id);
                                                    $user_name = !empty($freelancer) ? Helper::getUsername($freelancer->seller_id) : '';
                                                    $amount = !empty($service->price) ? $service->price - ($service->price / 100) * $admin_commission : 0;
                                                ?>
                                                <tr class="wt-earning-contents">
                                                    <td class="wt-earnig-single" data-th="Project Title"><span class="bt-content"><?php echo e($service->title); ?></span></td>
                                                    <td data-th="Date"><span class="bt-content"><?php echo e($service->updated_at); ?></span></td>
                                                    <td data-th="Earnings"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($amount); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </table>
                        </div>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>