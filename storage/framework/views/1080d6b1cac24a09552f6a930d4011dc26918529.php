
<nav id="wt-nav" class="wt-nav navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="lnr lnr-menu"></i>
    </button>
    <div class="collapse navbar-collapse wt-navigation" id="navbarNav">
        <ul class="navbar-nav">
            <?php if((!empty($pages) || Schema::hasTable('pages')) && false): ?>
                <?php $order=''; $page_order=''; ?>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $page_order = DB::table('metas')
                                        ->select('meta_value')
                                        ->where('meta_key', 'page_order')
                                        ->where('metable_type', 'App\Page')
                                        ->where('metable_id', $page->id)->first();
                        $order = !empty($page_order->meta_value) ? $page_order->meta_value : '';
                        $page_has_child = App\Page::pageHasChild($page->id); $pageID = Request::segment(2);
                        $show_page = \App\SiteManagement::where('meta_key', 'show-page-'.$page->id)->select('meta_value')->pluck('meta_value')->first();
                    ?>
                    <?php if($page->relation_type == 0 && ($show_page == 'true' || $show_page == true)): ?>
                        <li 
                            class="<?php echo e(!empty($page_has_child) ? 'menu-item-has-children page_item_has_children' : ''); ?> <?php if($pageID == $page->slug ): ?> current-menu-item <?php endif; ?>"
                            style="<?php echo e(!empty($order) ? 'order:'.$order : 'order:99'); ?>"
                        >
                            <a href="<?php echo e(url('page/'.$page->slug)); ?>"><?php echo e($page->title); ?></a>
                            <?php if(!empty($page_has_child)): ?>
                                <ul class="sub-menu">
                                    <?php $__currentLoopData = $page_has_child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $child = App\Page::getChildPages($parent->child_id);?>
                                        <?php if(!empty($child)): ?>
                                            <li class="<?php if($pageID == $child->slug ): ?> current-menu-item <?php endif; ?>">
                                                <a href="<?php echo e(url('page/'.$child->slug.'/')); ?>">
                                                    <?php echo e($child->title); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php
                $inner_page  = App\SiteManagement::getMetaValue('inner_page_data');
                $add_f_navbar = !empty($inner_page) && !empty($inner_page[0]['add_f_navbar']) ? $inner_page[0]['add_f_navbar'] : '';
                $add_emp_navbar = !empty($inner_page) && !empty($inner_page[0]['add_emp_navbar']) ? $inner_page[0]['add_emp_navbar'] : '';
                $add_job_navbar = !empty($inner_page) && !empty($inner_page[0]['add_job_navbar']) ? $inner_page[0]['add_job_navbar'] : '';
                $add_service_navbar = !empty($inner_page) && !empty($inner_page[0]['add_service_navbar']) ? $inner_page[0]['add_service_navbar'] : '';
                $add_article_navbar = !empty($inner_page) && !empty($inner_page[0]['add_article_navbar']) ? $inner_page[0]['add_article_navbar'] : '';
                $menu_settings  = App\SiteManagement::getMetaValue('menu_settings');
                $freelancer_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'freelancers') : ""; 
                $employer_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'employers') : ''; 
                $job_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'jobs') : ''; 
                $service_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'services') : ''; 
                $article_order = !empty($menu_settings['pages']) ? Helper::getArrayIndex($menu_settings['pages'], 'id', 'articles') : ''; 
            ?>
            <?php if($add_article_navbar !== 'false'): ?>
                <li style="<?php echo e(!empty($article_order) ? 'order:'.$article_order : 'order:99'); ?>">
                    <a href="<?php echo e(url('articles')); ?>">
                        <?php echo e(trans('lang.articles')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if($add_f_navbar !== 'false'): ?>
                <li style="<?php echo e(!empty($freelancer_order) ? 'order:'.$freelancer_order : 'order:99'); ?>">
                    <a href="<?php echo e(url('search-results?type=freelancer')); ?>">
                        <?php echo e(trans('lang.view_freelancers')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if($add_emp_navbar !== 'false'): ?>
            <li style="<?php echo e(!empty($employer_order) ? 'order:'.$employer_order : 'order:99'); ?>">
                <a href="<?php echo e(url('search-results?type=employer')); ?>">
                    <?php echo e(trans('lang.view_employers')); ?>

                </a>
            </li>
            <?php endif; ?>
            <?php if($add_job_navbar !== 'false'): ?>
                <?php if($type =='jobs' || $type == 'both'): ?>
                    <li style="<?php echo e(!empty($job_order) ? 'order:'.$job_order : 'order:99'); ?>">
                        <a href="<?php echo e(url('search-results?type=job')); ?>">
                            <?php echo e(trans('lang.browse_jobs')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($add_service_navbar !== 'false'): ?>
                <?php if($type =='services' || $type == 'both'): ?>
                    <li style="<?php echo e(!empty($service_order) ? 'order:'.$service_order : 'order:99'); ?>">
                        <a href="<?php echo e(url('search-results?type=service')); ?>">
                            <?php echo e(trans('lang.browse_services')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</nav>