<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" x-data="{ darkMode: true }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'YUWARAJAXVII')); ?> - SPV Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('images/logo-yuwarajaxvii.svg')); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/logo-yuwarajaxvii.svg')); ?>">
    <link rel="manifest" href="<?php echo e(asset('site.webmanifest')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'orbitron': ['Orbitron', 'sans-serif'],
                        'rajdhani': ['Rajdhani', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar Component -->
        <?php if (isset($component)) { $__componentOriginal8935c0a2b818400f842f86a7d6507803 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8935c0a2b818400f842f86a7d6507803 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-spv','data' => ['role' => 'spv']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-spv'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['role' => 'spv']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8935c0a2b818400f842f86a7d6507803)): ?>
<?php $attributes = $__attributesOriginal8935c0a2b818400f842f86a7d6507803; ?>
<?php unset($__attributesOriginal8935c0a2b818400f842f86a7d6507803); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8935c0a2b818400f842f86a7d6507803)): ?>
<?php $component = $__componentOriginal8935c0a2b818400f842f86a7d6507803; ?>
<?php unset($__componentOriginal8935c0a2b818400f842f86a7d6507803); ?>
<?php endif; ?>
        
        <!-- Main Content Area -->
        <div class="flex-1 lg:ml-72">
            <!-- Page Content -->
            <main class="min-h-screen">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/layouts/spv.blade.php ENDPATH**/ ?>