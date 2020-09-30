
<?php $__env->startPush('stylesheets'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('PackageStyle'); ?>
    <link href="<?php echo e(asset('css/dd.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('header'); ?>
	<?php if(file_exists(resource_path('views/extend/includes/header.blade.php'))): ?>
		<?php echo $__env->make('extend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php else: ?> 
		<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<?php echo $__env->yieldContent('exam_head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('slider'); ?>
    <?php echo $__env->yieldContent('homeSlider'); ?>
    <?php echo $__env->yieldContent('exam_top_bar'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<?php echo $__env->yieldPushContent('stylesheets'); ?>
<main id="wt-main" class="wt-main  wt-haslayout <?php echo e(!empty($body_class) ? $body_class : ''); ?>">
	<?php echo $__env->yieldContent('content'); ?>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php if(file_exists(resource_path('views/extend/front-end/includes/footer.blade.php'))): ?>
		<?php echo $__env->make('extend.front-end.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php else: ?> 
		<?php echo $__env->make('front-end.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/jquery.dd.min.js')); ?>"></script>	
<script>
	jQuery('.wt-btndemotoggle').on('click', function() {
		var _this = jQuery(this);
		_this.parents('.wt-demo-sidebar').toggleClass('wt-demoshow');
	});
	jQuery(document).ready(function(e) {
		try {
			jQuery("body select.locations").msDropDown();
		} catch(e) {
			alert(e.message);
		}
	});
</script>
    <?php echo $__env->yieldContent('exam_scripts'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>