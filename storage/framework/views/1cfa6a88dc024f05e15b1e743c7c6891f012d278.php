<aside id="wt-sidebar" class="wt-sidebar">
    <?php echo Form::open(['url' => url('search-results'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch']); ?>

        <input type="hidden" value="<?php echo e($type); ?>" name="type">
        
            
                
            
            
                
                    
                        
                            
                        
                    
                
            
        
        
            
                
            
            
                
                    
                        
                            
                        
                        
                            
                            
                            
                            
                            
                            
                            
                            
                        
                    
                    
                    
                
            
        
        
            
                
            
            
                
                    
                        
                        
                    
                
                
                    
                        
                            
                                
                                
                                    
                                    
                                
                            
                        
                    
                
            
        
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.locations')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="<?php echo e(trans('lang.ph_search_locations')); ?>">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    <?php if(!empty($locations)): ?>
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $checked = '';
                                    if (!empty($_GET['locations'])) {
                                        if (is_array($_GET['locations']) && in_array($location->slug, $_GET['locations'])) {
                                            $checked = 'checked';
                                        } elseif ( $location->slug == $_GET['locations']) {
                                            $checked = 'checked';     
                                        }
                                    } 
                                ?>
                                <span class="wt-checkbox">
                                    <input id="location-<?php echo e($location->slug); ?>" type="checkbox" name="locations[]" value="<?php echo e($location->slug); ?>" <?php echo e($checked); ?> >
                                    <label for="location-<?php echo e($location->slug); ?>"> <img src="<?php echo e(asset(Helper::getLocationFlag($location->flag))); ?>" alt="<?php echo e(trans('lang.img')); ?>"> <?php echo e($location->title); ?></label>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.langs')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="<?php echo e(trans('lang.ph_search_langs')); ?>">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    <?php if(!empty($languages)): ?>
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $checked = ( !empty($_GET['languages']) && in_array($language->slug, $_GET['languages'])) ? 'checked' : '' ?>
                                <span class="wt-checkbox">
                                    <input id="language-<?php echo e($language->slug); ?>" type="checkbox" name="languages[]" value="<?php echo e($language->slug); ?>" <?php echo e($checked); ?> >
                                    <label for="language-<?php echo e($language->slug); ?>"><?php echo e($language->title); ?></label>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.delivery_time')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="<?php echo e(trans('lang.ph_search_delivery_time')); ?>" >
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    <?php if(!empty($delivery_time)): ?>
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            <?php $__currentLoopData = $delivery_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $checked = ( !empty($_GET['delivery_time']) && in_array($time->slug, $_GET['delivery_time'])) ? 'checked' : '' ?>
                                <span class="wt-checkbox">
                                    <input id="time-<?php echo e($time->slug); ?>" type="checkbox" name="delivery_time[]" value="<?php echo e($time->slug); ?>" <?php echo e($checked); ?> >
                                    <label for="time-<?php echo e($time->slug); ?>"><?php echo e($time->title); ?></label>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.response_time')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control filter-records" placeholder="<?php echo e(trans('lang.ph_search_response_time')); ?>">
                        <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                    </div>
                </fieldset>
                <fieldset>
                    <?php if(!empty($response_time)): ?>
                        <div class="wt-checkboxholder wt-verticalscrollbar">
                            <?php $__currentLoopData = $response_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $checked = ( !empty($_GET['response_time']) && in_array($time->slug, $_GET['response_time'])) ? 'checked' : '' ?>
                                <span class="wt-checkbox">
                                    <input id="time-<?php echo e($time->slug); ?>" type="checkbox" name="response_time[]" value="<?php echo e($time->slug); ?>" <?php echo e($checked); ?> >
                                    <label for="time-<?php echo e($time->slug); ?>"><?php echo e($time->title); ?></label>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </fieldset>
            </div>
        </div>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgetcontent">
                <div class="wt-applyfilters">
                    <span><?php echo e(trans('lang.apply_filter')); ?><br> <?php echo e(trans('lang.changes_by_you')); ?></span>
                    <?php echo Form::submit(trans('lang.btn_apply_filters'), ['class' => 'wt-btn']); ?>

                </div>
            </div>
        </div>
    <?php echo Form::close(); ?>

</aside>
