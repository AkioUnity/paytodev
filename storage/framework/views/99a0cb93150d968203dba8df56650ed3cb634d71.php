
<?php $__env->startSection('content'); ?>
    <?php $breadcrumbs = Breadcrumbs::generate('createProposal', $job->slug); ?>
    <?php if(file_exists(resource_path('views/extend/front-end/includes/inner-banner.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.includes.inner-banner', 
            ['title' => trans('lang.job_proposal'), 'inner_banner' => '', 'show_banner' => 'true' ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('front-end.includes.inner-banner', 
            ['title' =>  trans('lang.job_proposal'), 'inner_banner' => '', 'show_banner' => 'true' ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <div id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="wt-haslayout wt-main-section">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2" id="jobs">
                        <div class="preloader-section" v-if="loading" v-cloak>
                            <div class="preloader-holder">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div class="wt-jobalertsholder la-jobalerts-holder">
                            <ul class="wt-jobalerts">
                                <?php if($submitted_proposals_count > 0): ?>
                                    <li class="alert alert-danger alert-dismissible fade show">
                                        <span><?php echo e(trans('lang.proposal_already_submitted')); ?></span>
                                        <a href="javascript:void(0)" class="wt-alertbtn danger close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($job->status != 'posted'): ?>
                                    <li class="alert alert-danger alert-dismissible fade show">
                                        <span><?php echo e(trans('lang.hired_freelancer_note')); ?></span>
                                        <a href="javascript:void(0)" class="wt-alertbtn danger close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($check_skill_req)): ?>
                                    <li class="alert alert-primary alert-dismissible fade show">
                                        <span><em><?php echo e(trans('lang.info')); ?>: </em> <?php echo e(trans('lang.skill_req_freelancer_note')); ?></span>
                                        <a href="javascript:void(0)" class="wt-alertbtn primary close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if($remaining_proposals <= $submitted_proposals): ?>
                                    <li class="alert alert-warning alert-dismissible fade show">
                                        <span><em><?php echo e(trans('lang.info')); ?>: </em>  You’ve consumed all you points to apply new job,</span>
                                        <a href="javascript:void(0)" class="wt-alertbtn primary close" data-dismiss="alert" aria-label="Close">Got It</a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                        <div class="wt-proposalholder">
                            <?php if(!empty($job->is_featured) && $job->is_featured === 'true'): ?>
                                <span class="wt-featuredtag"><img src="<?php echo e(asset('images/featured.png')); ?>" alt="<?php echo e(trans('lang.is_featured')); ?>" data-tipso="Plus Member" class="template-content tipso_style"></span>
                            <?php endif; ?>
                            <div class="wt-proposalhead">
                                <?php if(!empty($job->title)): ?>
                                    <h2><?php echo e($job->title); ?></h2>
                                <?php endif; ?>
                                <ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
                                    <?php if(!empty($job->price)): ?>
                                        <li>
                                            <span>
                                                <i class="wt-viewjobdollar"><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> <?php echo e($job->price); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(!empty($job->location->title)): ?>
                                        <li><span><img src="<?php echo e(asset(Helper::getLocationFlag($job->location->flag))); ?>" alt="<?php echo e(trans('lang.img')); ?>"> <?php echo e($job->location->title); ?></span></li>
                                    <?php endif; ?>
                                    <?php if(!empty($job->project_type)): ?>
                                        <?php $project_type  = Helper::getProjectTypeList($job->project_type); ?>
                                        <li><span class="wt-clicksavefolder"><img class="wt-job-icon" src="<?php echo e(asset('images/job-icons/job-type.png')); ?>"> <?php echo e(trans('lang.type')); ?> <?php echo e($project_type); ?></span></li>
                                    <?php endif; ?>
                                    <?php if(!empty($job->duration)): ?>
                                        <li><span class="wt-dashboradclock"><img class="wt-job-icon" src="<?php echo e(asset('images/job-icons/job-duration.png')); ?>"> <?php echo e(trans('lang.duration')); ?> <?php echo e(Helper::getJobDurationList($job->duration)); ?></span></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="wt-proposalamount-holder">
                            <div class="wt-title">
                                <h2><?php echo e(trans('lang.proposal_amount')); ?></h2>
                            </div>
                            <?php echo Form::open(['url' => url('proposal/submit-proposal'), 'class' =>'wt-haslayout', 'id' => 'send-propsal',  '@submit.prevent'=>'submitJobProposal('.$job->id.', '.Auth::user()->id.')']); ?>

                                <div class="wt-proposalamount accordion">
                                    <div class="form-group">
                                        <span>( <i><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> )</span>
                                        <?php echo Form::input('number', 'amount', null, ['class' => 'form-control', 'min' => 1, 'placeholder' => trans('lang.ph_proposal_amount'), 'v-model'=>'proposal.amount', 'v-on:keyup' => "calculate_amount('$commision')" ]); ?>

                                        <a href="javascript:void(0);" class="collapsed" id="headingOne" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="lnr lnr-chevron-up"></i>
                                        </a>
                                        <em><?php echo e(trans('lang.amount_note')); ?></em>
                                    </div>
                                    <ul class="wt-totalamount collapse show" id="collapseOne" aria-labelledby="headingOne">
                                        <li v-cloak>
                                            <h3>( <i><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> ) <em>- {{this.proposal.deduction}}</em></h3>
                                            <span><strong>“ <?php echo e(trans('lang.worketic')); ?> ”</strong> <?php echo e(trans('lang.service_fee')); ?>

                                                <i class="fa fa-exclamation-circle template-content tipso_style" data-tipso="Plus Member"></i>
                                            </span>
                                        </li>
                                        <li v-cloak>
                                            <h3>( <i><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> ) <em>{{this.proposal.total}}</em></h3>
                                            <span>
                                                <?php echo e(trans('lang.receiving_amount')); ?> <strong>“ <?php echo e(trans('lang.receiving_amount')); ?> ”</strong>
                                                <?php echo e(trans('lang.fee_deduction')); ?>

                                                <i class="fa fa-exclamation-circle template-content tipso_style" data-tipso="Plus Member"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    
                                    <fieldset>
                                        <legend>Milestones:</legend>
                                        <div class="form-group">
                                            <div class="form-group-holder">
                                                <input type="text" class="form-control" placeholder="milestone name" id="milestone_name">
                                                <input type="number" class="form-control" min="0" placeholder="price" id="milestone_price">
                                            </div>
                                        </div>
                                        <div class="form-group wt-btnarea">
                                            <button v-on:click="addMilestone">Add Milestone</button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="wt-formtheme wt-formproposal">
                                    <fieldset>
                                        <div class="form-group">
                                            <span class="wt-select">
                                                <?php echo Form::select('completion_time', $job_completion_time, null, array('v-model'=>'proposal.completion_time', 'placeholder' => trans('lang.ph_job_completion_time') )); ?>

                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'id' => '', 'placeholder' =>  trans('lang.ph_cover_letter') , 'v-model'=>'proposal.description']); ?>

                                        </div>
                                    </fieldset>
                                    <div class="wt-attachments wt-attachmentsvtwo wt-attachmentsholder lara-proposal-attachment">
                                        <div class="lara-attachment-files">
                                            <div class="wt-title">
                                                <h3><?php echo e(trans('lang.upload_file')); ?></h3>
                                            </div>
                                            <job_attachments :temp_url="'<?php echo e(url('proposal/upload-temp-image')); ?>'"></job_attachments>
                                            <div class="form-group input-preview">
                                                <ul class="wt-attachfile dropzone-previews">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-btnarea">
                                        <?php echo Form::submit(trans('lang.btn_send'), ['class' => 'wt-btn']); ?>

                                    </div>
                                </div>
                            <?php echo form::close();; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>