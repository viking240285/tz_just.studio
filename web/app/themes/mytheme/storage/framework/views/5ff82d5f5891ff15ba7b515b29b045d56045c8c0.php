<?php $__env->startSection('content'); ?>

	<div class="md:mx-60">
		<section id="feature">
        <h5 class="text-white feature_title text-center dark:text-white font-bold md:text-2xl sm:text-xl">
            Featured Luxury Cars
        </h5>
        <div class="flex justify-center items-center my-16">
            <a href="<?php echo e(home_url('/catalog')); ?>" class="feature_img bg-indigo-400 ml-4 mr-4 text-white p-4 rounded-2xl">All</a>

            <?php $__currentLoopData = $car_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $brand_image = get_field('car_image_brend', 'car_brand_' . $brand->term_id);
                    $isActive = request()->query('brand') == $brand->slug;
                ?>
                <a href="<?php echo e(home_url('/catalog?brand=' . $brand->slug)); ?>" class="feature_img <?php echo e($isActive ? 'bg-indigo-400' : 'bg-gray-800'); ?> hover:bg-gray-600 mr-4 <?php echo e($isActive ? 'text-white' : 'text-zinc-400'); ?> p-4 rounded-2xl">
                    <?php if($brand_image): ?>
                        <img src="<?php echo e($brand_image['url']); ?>" class="w-5" alt="<?php echo e($brand->name); ?>">
                    <?php else: ?>
                        <?php echo e($brand->name); ?>

                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="flex gap-2 mt-16 mb-5 justify-center">
            <?php if(!empty($cars)): ?>
                <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(get_permalink($car->post_id)); ?>" class="w-1/3 feature_images bg-black hover:animate-pulse shadow hover:cursor-pointer hover:shadow-lg shadow-gray-700 rounded-lg mb-4 px-4">
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div>
                                <p class="dark:text-white text-black font-bold text-xl mb-4"><?php echo e($car->car_brand); ?></p>
                                <p class="dark:text-zinc-400 text-zinc-200 font-bold text-sm mb-4"><?php echo e($car->car_model); ?> / <?php echo e($car->year); ?></p>
                                <img src="<?php echo e($car->image); ?>" class="w-72 pl-5 duration-500 hover:-translate-y-5" alt="" /> <!-- Изменено на w-72 -->
                            </div>
                            <div class="mt-5 flex items-end justify-between h-10">
                                <p class="dark:text-zinc-400 text-zinc-200 font-bold pl-4">Год: <?php echo e($car->year); ?></p>
                            </div>
                        </div>
                    </a>
                    <?php if($loop->iteration % 3 == 0 && !$loop->last): ?>
                        </div><div class="flex gap-2 mt-4 mb-5">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="dark:text-white text-black font-bold text-xl">Автомобили не найдены.</p>
            <?php endif; ?>
        </div>


        <?php if(!empty($pagination)): ?>
            <div class="pagination flex justify-center text-white items-center mt-8 mb-28">
                <?php echo join(' ', $pagination); ?>

            </div>
        <?php endif; ?>

        
		</section>
    <section class="mx-60 my-20">
        <div class="flex justify-around w-full">
            <img src="<?php echo e(asset('images/logo1.png')); ?>"
                class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
            <img src="<?php echo e(asset('images/logo6.png')); ?>"
                class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
            <img src="<?php echo e(asset('images/logo3.png')); ?>"
                class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
            <img src="<?php echo e(asset('images/logo4.png')); ?>"
                class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
            <img src="<?php echo e(asset('images/logo5.png')); ?>"
                class="logo-img w-10 duration-300 hover:animate-pulse brightness-50 hover:brightness-200 cursor-pointer" alt="">
        </div>
    </section>
	</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/viking/Sites/my/wp/tz_just_studio/public_html/web/app/themes/mytheme/resources/views/page-catalog.blade.php ENDPATH**/ ?>