<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['role' => 'spv']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['role' => 'spv']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-data="{ sidebarOpen: false }" class="relative">
    <!-- Mobile Menu Button -->
    <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-black/20 backdrop-blur-sm border border-cyan-400/20">
        <svg class="h-6 w-6 text-cyan-400" x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg class="h-6 w-6 text-cyan-400" x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar Backdrop -->
    <div x-show="sidebarOpen"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm lg:hidden"
        @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar -->
    <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform lg:translate-x-0 bg-[#0A0F1A] border-r border-cyan-400/20">

        <!-- Logo & Title -->
        <a href="<?php echo e(route('spv.dashboard')); ?>" class="flex flex-col items-center justify-center h-36 px-4 bg-black/30 border-b border-cyan-400/20">
            <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo" class="h-16 mb-2">
            <h1 class="text-lg font-bold text-white font-orbitron">YUWARAJA XVII</h1>
        </a>

        <!-- Navigation -->
        <nav class="p-7 space-y-1.5">
            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.dashboard'),'active' => request()->routeIs('spv.dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.dashboard'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Dashboard
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.cluster.index'),'active' => request()->routeIs('spv.cluster.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.cluster.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.cluster.*'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Cluster
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.absensi.index'),'active' => request()->routeIs('spv.absensi.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.absensi.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.absensi.*'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Absensi
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.tugas.index'),'active' => request()->routeIs('spv.tugas.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.tugas.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.tugas.*'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Tugas
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.pengumpulan.index'),'active' => request()->routeIs('spv.pengumpulan.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.pengumpulan.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.pengumpulan.*'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Pengumpulan
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.nav-link','data' => ['href' => route('spv.pengumuman.index'),'active' => request()->routeIs('spv.pengumuman.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('spv.pengumuman.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('spv.pengumuman.*'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
                    </svg>
                 <?php $__env->endSlot(); ?>
                Pengumuman
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $attributes = $__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__attributesOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f)): ?>
<?php $component = $__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f; ?>
<?php unset($__componentOriginal993a4d47e1d9dcfd73a2a3bf4546333f); ?>
<?php endif; ?>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-cyan-400/20 bg-black/20">
            
            <?php
                $kelompokDibimbing = \App\Models\Kelompok::where('spv_id', Auth::id())->first();
            ?>
            <?php if($kelompokDibimbing): ?>
            <a href="<?php echo e(route('spv.cluster.index')); ?>" class="block mb-3 p-3 rounded-lg bg-cyan-400/10 border border-cyan-400/20 hover:bg-cyan-400/20 hover:border-cyan-400/40 transition-all duration-200 group">
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-400 group-hover:text-cyan-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <h4 class="text-sm font-semibold text-cyan-400 group-hover:text-cyan-300">Kelompok</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cyan-400/50 group-hover:text-cyan-300 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-white font-medium group-hover:text-cyan-100"><?php echo e($kelompokDibimbing->nama_kelompok); ?></p>
                    <p class="text-xs text-cyan-400/70 group-hover:text-cyan-300/80">Kode: <?php echo e($kelompokDibimbing->code); ?></p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-cyan-400 group-hover:text-cyan-300">
                            <?php echo e($kelompokDibimbing->users->count()); ?> Anggota
                        </span>
                        <span class="text-xs text-cyan-400/70 group-hover:text-cyan-300/80">
                            Klik untuk melihat →
                        </span>
                    </div>
                </div>
            </a>
            <?php endif; ?>

            <div class="flex items-center gap-3 px-2 py-2 mb-2 rounded-lg bg-cyan-400/5">
                <?php if(Auth::user()->photo): ?>
                <img src="<?php echo e(asset('profile-pictures/' . Auth::user()->photo)); ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-cyan-400/50">
                <?php else: ?>
                <div class="w-10 h-10 rounded-full bg-cyan-400/10 border-2 border-cyan-400/50 flex items-center justify-center">
                    <span class="text-lg font-semibold text-cyan-400"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                </div>
                <?php endif; ?>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate"><?php echo e(Auth::user()->name); ?></p>
                    <p class="text-xs text-cyan-400/70 truncate"><?php echo e(Auth::user()->program_studi); ?></p>
                </div>
                <a href="<?php echo e(route('profile.edit')); ?>" class="text-cyan-400 hover:text-cyan-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </a>
            </div>
            
            
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600/20 hover:bg-red-600/30 border border-red-500/30 text-red-400 text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>
</div>
<?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/components/sidebar-spv.blade.php ENDPATH**/ ?>