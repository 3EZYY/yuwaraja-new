<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active', 'href']));

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

foreach (array_filter((['active', 'href']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = ($active ?? false)
    ? 'flex items-center px-4 py-2 text-cyan-400 bg-cyan-400/10 rounded-lg transition-colors duration-200'
    : 'flex items-center px-4 py-2 text-gray-400 hover:text-cyan-400 hover:bg-cyan-400/10 rounded-lg transition-colors duration-200';
?>

<a <?php echo e($attributes->merge(['class' => $classes, 'href' => $href])); ?>>
    <?php if(isset($icon)): ?>
        <span class="mr-3"><?php echo e($icon); ?></span>
    <?php endif; ?>
    <?php echo e($slot); ?>

</a>
<?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/components/sidebar/nav-link.blade.php ENDPATH**/ ?>