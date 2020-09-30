
<?php $__env->startSection('content'); ?>
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-right" id="services">
				<div class="preloader-section" v-if="loading" v-cloak>
					<div class="preloader-holder">
						<div class="loader"></div>
					</div>
				</div>
				<div class="wt-dashboardbox wt-dashboardservcies">
					<div class="wt-dashboardboxtitle wt-titlewithsearch">
						<h2><?php echo e(trans('lang.services_listing')); ?></h2>
					</div>
					<div class="wt-dashboardboxcontent wt-categoriescontentholder">
						<?php if($orders->count() > 0): ?>
							<table class="wt-tablecategories wt-tableservice">
								<thead>
									<tr>
										<th><?php echo e(trans('lang.service_title')); ?></th>
										<th><?php echo e(trans('lang.employer')); ?></th>
										<th><?php echo e(trans('lang.order_status')); ?></th>
										<th><?php echo e(trans('lang.action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php 
											$service = App\Service::find($order->service_id);
											$attachment = Helper::getUnserializeData($service->attachments); 
											$employer = App\User::find($order->user_id);
										?>
										<tr class="del-<?php echo e($service->status); ?>">
											<td data-th="Service Title">
												<span class="bt-content">
													<div class="wt-service-tabel">
														<?php if(!empty($service->seller->count() > 0 && $attachment)): ?>
															<figure class="service-feature-image"><img src="<?php echo e(asset( Helper::getImageWithSize('uploads/services/'.$service->seller[0]->id, $attachment[0], 'small' ))); ?>" alt="<?php echo e($service->title); ?>"></figure>
														<?php endif; ?>
														<div class="wt-freelancers-content">
															<div class="dc-title">
																<?php if($service->is_featured == 'true'): ?>
																	<span class="wt-featuredtagvtwo">Featured</span>
																<?php endif; ?>
																<h3><?php echo e($service->title); ?></h3>
																<span><strong><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?><?php echo e($service->price); ?></strong> <?php echo e(trans('lang.starting_from')); ?></span>
															</div>
														</div>
													</div>
												</span>
											</td>
											<?php if(!empty($employer)): ?>
												<td>
													<span class="bt-content">
														<div class="wt-service-tabel">
															<?php if(!empty($attachment)): ?>
																<figure class="service-feature-image"><img src="<?php echo e(asset(Helper::getProfileImage($employer->id))); ?>" alt="<?php echo e(trans('lang.image')); ?>"></figure>
															<?php endif; ?>
															<div class="wt-freelancers-content">
																<div class="dc-title">
																	<?php if($employer->user_verified == 1): ?>
																		<span class="wt-featuredtagvtwo"><?php echo e(trans('lang.featured')); ?></span>
																	<?php endif; ?>
																	<a href="<?php echo e(url('profile/'.$employer->slug)); ?>"><h3><?php echo e(Helper::getUserName($employer->id)); ?></h3></a>
																</div>
															</div>
														</div>
													</span>
												</td>
											<?php endif; ?>
											<td>
												<span class="la-order-status <?php echo e($order->status == 'cancelled' ? 'la-order-cancelled' : ''); ?>">
													<h4><?php echo e($order->status); ?></h4>
												</span>
											</td>
											<td data-th="Action">
												<span class="bt-content">
													<div class="wt-actionbtn">
														<a href="<?php echo e(route('serviceDetail',$service->slug)); ?>" class="wt-viewinfo">
															<i class="lnr lnr-eye"></i>
														</a>
														<a href="<?php echo e(url('freelancer/service/'.$order->id.'/'.$order->status)); ?>" class="wt-addinfo wt-skillsaddinfo">
															<i class="lnr lnr-history"></i>
														</a>
														<?php if($order->status == 'cancelled' && Helper::getOrderPayout($order->id)->count() == 0): ?>
															<a href="javascript:void(0);" v-on:click.prevent="showRefoundForm(<?php echo e($order->id); ?>)" class="wt-deleteinfo">
																<i class="fa fa-gavel"></i>
															</a>
															<b-modal ref="myModalRef-<?php echo e($order->id); ?>" hide-footer title="Refund" v-cloak>
																<div class="d-block text-center">
																	<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme', 'id' => 'submit_refund_'.$order->id,  '@submit.prevent'=>'submitRefund("'.$order->id.'")']); ?>

																		<fieldset>
																			<div class="form-group">
																				<span class="wt-select">
																					<select id="refundable_user_id-<?php echo e($order->id); ?>" class="form-control" placeholder="<?php echo e(trans('lang.select_users')); ?>" v-model="refundable_user">
																						<option value=""><?php echo e(trans('lang.select_users')); ?></option>
																						<option value="<?php echo e($employer->id); ?>"><?php echo e(trans('lang.search_filter_list.employers_val')); ?></option>
																						<option value="<?php echo e($order->seller_id); ?>"><?php echo e(trans('lang.search_filter_list.freelancer_val')); ?></option>
																					</select>
																				</span>
																			</div>
																			
																			<input type="hidden" value="<?php echo e($service->price); ?>" id="refundable-amount-<?php echo e($order->id); ?>">
																			
																			<div class="form-group wt-btnarea">
																				<?php echo Form::submit(trans('lang.refund'), ['class' => 'wt-btn']); ?>

																			</div>
																		</fieldset>
																	<?php echo form::close();; ?>

																</div>
															</b-modal>	
														<?php endif; ?>
													</div>
												</span>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						<?php else: ?>
							<?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?> 
								<?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php else: ?> 
								<?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php if( method_exists($orders,'links') ): ?> <?php echo e($orders->links('pagination.custom')); ?> <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>