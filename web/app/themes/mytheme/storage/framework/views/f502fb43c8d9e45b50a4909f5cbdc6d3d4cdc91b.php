<header class="banner">
  <div class="md:mx-60 sticky top-0 z-50">
    <div class="container shadow-2xl  flex animate__animated items-center my-2 py-2 justify-between bg-black z-50 dark:bg-black sticky top-0 position-fixed"
        id="nav">
        <a href="<?php echo e(home_url('/')); ?>" class="text-dark dark:text-white columns-9 flex items-center mb-0">
            <img src="<?php echo e(asset('images/favicon.png')); ?>" class="mr-2 bg-black rounded" alt="">
            <p class="mb-0 text-white dark:text-white md:text-xl text-2xl"><?php echo $siteName; ?></p>
        </a>
        <div class="md:hidden block">
            <i class="ri-menu-3-line text-2xl text-dark dark:text-white"></i>
        </div>
        <?php if(has_nav_menu('primary_navigation')): ?>
          <nav class="nav-primary" aria-label="<?php echo e(wp_get_nav_menu_name('primary_navigation')); ?>">
            <?php echo wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]); ?>

          </nav>
          <div class="md:block hidden">
              <a href="#home" class="dark:text-white text-black hover:text-indigo-400 mr-2">Home</a>
              <a href="#about" class="dark:text-white hover:text-indigo-400 mr-2">About</a>
              <a href="#home" class="dark:text-white hover:text-indigo-400 mr-2">Popular</a>
              <a href="#home" class="dark:text-white hover:text-indigo-400 mr-2">Featured</a>
              <div class="dark:inline dark:block hidden ml-6" id="">
                  <i id="light" class="ri-sun-fill text-black dark:text-white text-2xl"></i>
              </div>
              <div class="inline block dark:hidden ml-6" id="">
                  <i id="dark" class="ri-moon-fill text-black dark:text-white text-2xl"></i>
              </div>
          </div>
        <?php endif; ?>
    </div>
  </div>
</header>
<?php /**PATH /Users/viking/Sites/my/wp/tz_just_studio/public_html/web/app/themes/mytheme/resources/views/sections/header.blade.php ENDPATH**/ ?>