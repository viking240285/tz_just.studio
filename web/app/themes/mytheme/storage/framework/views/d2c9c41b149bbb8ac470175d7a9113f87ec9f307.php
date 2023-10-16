<?php $__env->startSection('content'); ?>
<section id="" class="mb-10 pt-28">
    
    
    <div class="image-bg flex justify-between gap-20 items-center relative" style="background-image: url('<?php echo e(asset('images/offer-bg.webp')); ?>');">
            <!-- Добавляем псевдоэлемент для затемнения -->
        
        <div id="about" class="w-1/2 relative about_left">
            <img src="<?php echo e($car->image); ?>" class="rounded-lg shadow-sm" alt="">
        </div>
        <div class="w-1/2 about_right">
            <h5 class="text-white dark:text-white font-bold md:text-4xl sm:text-xl">
                <?php echo e($car->car_brand); ?> <?php echo e($car->post_title); ?>

            </h5>
            <p class="text-gray-500 my-12">
                <ul class="list-none list-inside text-white">
                    <li><strong>Модель:</strong> <?php echo e($car->post_title); ?></li>
                    <li><strong>Бренд:</strong>
                        <?php if(!empty($car->car_brand)): ?>
                            <a href="<?php echo e(home_url('/catalog?brand=' . $car->car_brand)); ?>" class="text-blue-500 hover:underline"><?php echo e($car->car_brand); ?></a>
                        <?php else: ?>
                            <?php echo e($car->car_brand ?: '-'); ?>

                        <?php endif; ?>
                    </li>
                    <li><strong>Тип двигателя:</strong> <?php echo e($car->engine_type ?: '-'); ?></li>
                    <li><strong>Трансмиссия:</strong> <?php echo e($car->transmission_type ?: '-'); ?></li>
                    <li><strong>Год выпуска:</strong>
                        <?php if(!empty($car->year)): ?>
                            <a href="<?php echo e(home_url('/catalog?year=' . $car->year)); ?>" class="text-blue-500 hover:underline"><?php echo e($car->year); ?></a>
                        <?php else: ?>
                            <?php echo e($car->year ?: '-'); ?>

                        <?php endif; ?>
                    </li>
                    <li><strong>Запас хода (км):</strong> <?php echo e($car->range_km ?: '-'); ?></li>
                </ul>
            </p>
        </div>
    </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/viking/Sites/my/wp/tz_just_studio/public_html/web/app/themes/mytheme/resources/views/single-car.blade.php ENDPATH**/ ?>