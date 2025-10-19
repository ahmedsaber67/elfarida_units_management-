<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Elfarida Online')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          beige: '#f5f5dc',
          brown: '#8b4513',
          lightbrown: '#a0522d',
        }
      }
    }
  }
</script>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
    <div class="app-container">

        <!-- Header -->

        <?php if(isset($header)): ?>
            <header class="main-header">
                <div class="header-content">
                    <?php echo e($header); ?>


                

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="main-content">
<!-- Navbar -->
<nav class="bg-[#f5f0e6] border-b border-[#d6c6b8] shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Left Side -->
            <div class="flex items-center">
                <a href="<?php echo e(route('units.index')); ?>" class="flex items-center text-[#6b4f3f] font-extrabold text-xl">
                 <h2>الفريدة</h2>
                </a>
            </div>

            <!-- Center Links -->
            <div class="flex space-x-4 items-center">
                <a href="<?php echo e(route('units.index')); ?>" 
                   class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                   الوحدات
                </a>

                <?php if(auth()->check() && in_array(auth()->user()->role, ['admin','supervisor'])): ?>
                    <a href="<?php echo e(route('statistics.index')); ?>" 
                       class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                       الإحصائيات
                    </a>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('units.bulk')); ?>" 
                       class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                       Bulk Control
                    </a>
                <?php endif; ?>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-3">
                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center space-x-2 bg-[#e6d8c3] px-3 py-2 rounded-md shadow">
                        <span class="text-[#6b4f3f] font-semibold">
                            مرحباً، <?php echo e(auth()->user()->name); ?>

                        </span>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="bg-[#6b4f3f] text-white px-3 py-2 rounded-md hover:bg-#5a3e30 transition shadow">
                                تسجيل خروج
                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>"
                       class="bg-[#6b4f3f] text-white px-3 py-2 rounded-md hover:bg-[#5a3e30] transition shadow">
                       تسجيل دخول
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>  <?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/layouts/app.blade.php ENDPATH**/ ?>