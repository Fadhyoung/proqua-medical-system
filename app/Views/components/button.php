<?php

$label = $label ?? 'Button';
$type = $type ?? 'button';
$id = $id ?? '';
$variant = $variant ?? 'primary';
$extra = $extra ?? '';
$onclick = $onclick ?? '';

$styles = [
    'primary' => 'bg-blue-500 hover:bg-blue-600 text-white',
    'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white',
    'danger' => 'bg-red-500 hover:bg-red-600 text-white',
    'success' => 'bg-green-500 hover:bg-green-600 text-white',
];

$class = $styles[$variant] ?? $styles['primary'];
?>

<button type="<?= $type ?>" id="<?= $id ?>" class="px-4 py-2 rounded <?= $class ?> <?= $extra ?>" <?= $onclick ? "onclick=\"$onclick\"" : '' ?>>
    <?= $label ?>
</button>
