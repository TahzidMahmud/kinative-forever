<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-xl-10 mx-auto">
		<h6 class="fw-600"><?php echo e(translate('Home Page Settings')); ?></h6>

		
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Top Banner')); ?>(Only 1)</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					<?php echo e(translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.')); ?>

				</div>
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Photos & Links')); ?></label>
						<div class="home-slider-target">
							<input type="hidden" name="types[]" value="home_slider_images">
							<input type="hidden" name="types[]" value="home_slider_links">
							<?php if(get_setting('home_slider_images') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('home_slider_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="home_slider_images">
					                                <input type="hidden" name="home_slider_images[]" class="selected-files" value="<?php echo e(json_decode(get_setting('home_slider_images'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_slider_links">
												<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="<?php echo e(json_decode(get_setting('home_slider_links'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>

                        <button
                        type="button"
                        class="btn btn-soft-secondary btn-sm"
                        data-toggle="add-more"
                        data-content='
                        <div class="row gutters-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                        </div>
                                        <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                        <input type="hidden" name="types[]" value="home_slider_images">
                                        <input type="hidden" name="home_slider_images[]" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="hidden" name="types[]" value="home_slider_links">
                                    <input type="text" class="form-control" placeholder="http://" name="home_slider_links[]">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>'
                        data-target=".home-slider-target">
                        <?php echo e(translate('Add New')); ?>

                    </button>

					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>





		
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Handpicked Categories')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Categories')); ?></label>
						<div class="home-categories-target">
							<input type="hidden" name="types[]" value="home_categories">
							<?php if(get_setting('home_categories') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('home_categories'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" data-selected=<?php echo e($value); ?> required>
													<?php $__currentLoopData = \App\Category::where('parent_id', 0)->with('childrenCategories')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name')); ?></option>
														<?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php echo $__env->make('categories.child_category', ['child_category' => $childCategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                            </select>
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='<div class="row gutters-5">
								<div class="col">
									<div class="form-group">
										<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
											<?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name')); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".home-categories-target">
							<?php echo e(translate('Add New')); ?>

						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>

		
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Home Banner 1 (Max 3)')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Banner & Links')); ?></label>
						<div class="home-banner1-target">
							<input type="hidden" name="types[]" value="home_banner1_images">
							<input type="hidden" name="types[]" value="home_banner1_links">
							<?php if(get_setting('home_banner1_images') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('home_banner1_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-5">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="home_banner1_images">
					                                <input type="hidden" name="home_banner1_images[]" class="selected-files" value="<?php echo e(json_decode(get_setting('home_banner1_images'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_labels">
												<input type="text" class="form-control" placeholder="Title" name="home_banner1_labels[]" value="<?php echo e(json_decode(get_setting('home_banner1_labels'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="<?php echo e(json_decode(get_setting('home_banner1_links'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-5">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
											</div>
											<div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
											<input type="hidden" name="types[]" value="home_banner1_images">
											<input type="hidden" name="home_banner1_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_labels">
										<input type="text" class="form-control" placeholder="Title" name="home_banner1_labels[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]">
									</div>
								</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-banner1-target">
							<?php echo e(translate('Add New')); ?>

						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>

		

		
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Home Categories')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Categories')); ?></label>
						<div class="home-categories-2-target">
							<input type="hidden" name="types[]" value="home_categories_2">
							<?php if(get_setting('home_categories_2') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('home_categories_2'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-xl">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="home_categories_2[]" data-live-search="true" data-selected="<?php echo e($value); ?>" required>
													<?php $__currentLoopData = \App\Category::where('parent_id', 0)->with('childrenCategories')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name')); ?></option>
														<?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php echo $__env->make('categories.child_category', ['child_category' => $childCategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                            </select>
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='<div class="row gutters-5">
								<div class="col-xl">
									<div class="form-group">
										<select class="form-control aiz-selectpicker" name="home_categories_2[]" data-live-search="true" required>
											<?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name')); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".home-categories-2-target">
							<?php echo e(translate('Add New')); ?>

						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>

		
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Home Banner 2 (Max 3)')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Banner & Links')); ?></label>
						<div class="home-banner2-target">
							<input type="hidden" name="types[]" value="home_banner2_images">
							<input type="hidden" name="types[]" value="home_banner2_links">
							<?php if(get_setting('home_banner2_images') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('home_banner2_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="home_banner2_images">
					                                <input type="hidden" name="home_banner2_images[]" class="selected-files" value="<?php echo e(json_decode(get_setting('home_banner2_images'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_titles">
												<input type="text" class="form-control" placeholder="Title" name="home_banner2_titles[]" value="<?php echo e(json_decode(get_setting('home_banner2_titles'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_sub_titles">
												<input type="text" class="form-control" placeholder="Subtitle" name="home_banner2_sub_titles[]" value="<?php echo e(json_decode(get_setting('home_banner2_sub_titles'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="<?php echo e(json_decode(get_setting('home_banner2_links'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-4">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
											</div>
											<div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
											<input type="hidden" name="types[]" value="home_banner2_images">
											<input type="hidden" name="home_banner2_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_titles">
										<input type="text" class="form-control" placeholder="Title" name="home_banner2_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_sub_titles">
										<input type="text" class="form-control" placeholder="Subtitle" name="home_banner2_sub_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]">
									</div>
								</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-banner2-target">
							<?php echo e(translate('Add New')); ?>

						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>

		
		
          
          <div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Mid banner Texts')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label><?php echo e(translate('Title')); ?></label>
                        <input type="hidden" name="types[]" value="midbanner_text_title">
                        <input type="text" class="form-control" placeholder="Title" name="midbanner_text_title" value="<?php echo e(get_setting('midbanner_text_title')); ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(translate('Subtitle')); ?></label>
                        <input type="hidden" name="types[]" value="midbanner_text_subtitle">
                        <input type="text" class="form-control" placeholder="Subtitle" name="midbanner_text_subtitle" value="<?php echo e(get_setting('midbanner_text_subtitle')); ?>">
                    </div>
                    
                    <div class="form-group">
						<label><?php echo e(translate('Icons')); ?>(max 3)</label>
						<div class="mid_banner_tex">
							<input type="hidden" name="types[]" value="mid_banner_icons">

							<?php if(get_setting('mid_banner_icons') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('mid_banner_icons'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="mid_banner_icons">
					                                <input type="hidden" name="mid_banner_icons[]" class="selected-files" value="<?php echo e(json_decode(get_setting('mid_banner_icons'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>

										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>

                        <button
                        type="button"
                        class="btn btn-soft-secondary btn-sm"
                        data-toggle="add-more"
                        data-content='
                        <div class="row gutters-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                        </div>
                                        <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                        <input type="hidden" name="types[]" value="mid_banner_icons">
                                        <input type="hidden" name="mid_banner_icons[]" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>'
                        data-target=".mid_banner_tex">
                        <?php echo e(translate('Add New')); ?>

                    </button>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>
        
        <div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('mid Banner')); ?>(Only 2)</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					<?php echo e(translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.')); ?>

				</div>
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Photos & Links')); ?></label>
						<div class="mid_banner-target">
							<input type="hidden" name="types[]" value="mid_banner_images">
							<input type="hidden" name="types[]" value="mid_banner_links">
							<?php if(get_setting('mid_banner_images') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('mid_banner_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="mid_banner_images">
					                                <input type="hidden" name="mid_banner_images[]" class="selected-files" value="<?php echo e(json_decode(get_setting('mid_banner_images'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="mid_banner_links">
												<input type="text" class="form-control" placeholder="http://" name="mid_banner_links[]" value="<?php echo e(json_decode(get_setting('mid_banner_links'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>

                        <button
                        type="button"
                        class="btn btn-soft-secondary btn-sm"
                        data-toggle="add-more"
                        data-content='
                        <div class="row gutters-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                        </div>
                                        <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                        <input type="hidden" name="types[]" value="mid_banner_images">
                                        <input type="hidden" name="mid_banner_images[]" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="hidden" name="types[]" value="mid_banner_links">
                                    <input type="text" class="form-control" placeholder="http://" name="mid_banner_links[]">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>'
                        data-target=".mid_banner-target">
                        <?php echo e(translate('Add New')); ?>

                    </button>

					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>
         
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Bottom Banner')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
	                    <label class="form-label"><?php echo e(translate('Image')); ?></label>
	                    <div class="input-group " data-toggle="aizuploader" data-type="image">
	                        <div class="input-group-prepend">
	                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
	                        </div>
	                        <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
							<input type="hidden" name="types[]" value="bottom_image">
	                        <input type="hidden" name="bottom_image" class="selected-files" value="<?php echo e(get_setting('bottom_image')); ?>">
	                    </div>
						<div class="file-preview"></div>
	                </div>
                    <div class="form-group ">
                        <label><?php echo e(translate('Link')); ?></label>
                        <input type="hidden" name="types[]" value="bottom_link">
                        <input type="text" class="form-control" placeholder="http://" name="bottom_link" value="<?php echo e(get_setting('bottom_link')); ?>">
                    </div>
                    <div class="form-group ">
                        <label><?php echo e(translate('Title')); ?></label>
                        <input type="hidden" name="types[]" value="bottom_title">
                        <input type="text" class="form-control" placeholder="" name="bottom_title" value="<?php echo e(get_setting('bottom_title')); ?>">
                    </div>
	                <div class="form-group ">
                        <label><?php echo e(translate('Sub-Title')); ?></label>
                        <input type="hidden" name="types[]" value="bottom_sub_title">
                        <input type="text" class="form-control" placeholder="" name="bottom_sub_title" value="<?php echo e(get_setting('bottom_sub_title')); ?>">
                    </div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>

        
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0"><?php echo e(translate('Feature Icons (Max 5)')); ?></h6>
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('business_settings.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="form-group">
						<label><?php echo e(translate('Banner & Links')); ?></label>
						<div class="feature_icons">
							<input type="hidden" name="types[]" value="feature_icon_images">
							<?php if(get_setting('feature_icon_images') != null): ?>
								<?php $__currentLoopData = json_decode(get_setting('feature_icon_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
					                                </div>
					                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
													<input type="hidden" name="types[]" value="feature_icon_images">
					                                <input type="hidden" name="feature_icon_images[]" class="selected-files" value="<?php echo e(json_decode(get_setting('feature_icon_images'), true)[$key]); ?>">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="feature_icon_titles">
												<input type="text" class="form-control" placeholder="Title" name="feature_icon_titles[]" value="<?php echo e(json_decode(get_setting('feature_icon_titles'), true)[$key]); ?>">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="feature_icon_sub_titles">
												<input type="text" class="form-control" placeholder="Subtitle" name="feature_icon_sub_titles[]" value="<?php echo e(json_decode(get_setting('feature_icon_sub_titles'), true)[$key]); ?>">
											</div>
										</div>

										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-4">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
											</div>
											<div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
											<input type="hidden" name="types[]" value="feature_icon_images">
											<input type="hidden" name="feature_icon_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="feature_icon_titles">
										<input type="text" class="form-control" placeholder="Title" name="feature_icon_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="feature_icon_sub_titles">
										<input type="text" class="form-control" placeholder="Subtitle" name="feature_icon_sub_titles[]">
									</div>
								</div>

								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".feature_icons">
							<?php echo e(translate('Add New')); ?>

						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
					</div>
				</form>
			</div>
		</div>


	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/website_settings/pages/home_page_edit.blade.php ENDPATH**/ ?>