<?php if( Schema::hasTable('site_managements')): ?>
    <?php
        $footer = \App\SiteManagement::getMetaValue('footer_settings');
        $search_menu = \App\SiteManagement::getMetaValue('search_menu');
        $menu_title = DB::table('site_managements')->select('meta_value')->where('meta_key', 'menu_title')->get()->first();
        $page_id='';
        if (!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' && Route::getCurrentRoute()->uri() != 'home') {
            if (Request::segment(1) == 'page') {
                $selected_page_data = APP\Page::getPageData(Request::segment(2));
                $selected_page = !empty($selected_page_data) ? APP\Page::find($selected_page_data->id) : '';
                $page_id = !empty($selected_page) ? $selected_page->id : '';
            }
        } else {
            $page_id = APP\SiteManagement::getMetaValue('homepage')['home'];
        }
        $page_footer = Helper::getPageFooter($page_id);
        $selected_footer = !empty($footer['footer_style']) ? $footer['footer_style'] : '';
        $role = Auth::user() ? Auth::user()->getRoleNames()[0] : '';
    ?>
    <?php if(!empty($page_footer) && $page_footer == 'style2'): ?>
        <?php if(file_exists(resource_path('views/extend/front-end/includes/footers/footer2.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.includes.footers.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.includes.footers.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php elseif(!empty($page_footer) && $page_footer == 'style3'): ?>
        <?php if(file_exists(resource_path('views/extend/front-end/includes/footers/footer3.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.includes.footers.footer3', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.includes.footers.footer3', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php elseif(!empty($selected_footer) && $selected_footer == 'style2'): ?> 
        <?php if(file_exists(resource_path('views/extend/front-end/includes/footers/footer2.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.includes.footers.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.includes.footers.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php elseif(!empty($selected_footer) && $selected_footer == 'style3'): ?> 
        <?php if(file_exists(resource_path('views/extend/front-end/includes/footers/footer3.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.includes.footers.footer3', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.includes.footers.footer3', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(file_exists(resource_path('views/extend/front-end/includes/footers/footer1.blade.php'))): ?> 
            <?php echo $__env->make('extend.front-end.includes.footers.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('front-end.includes.footers.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
