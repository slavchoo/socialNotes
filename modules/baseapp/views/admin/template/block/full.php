<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<article class="module width_full">
    <header><h3><?php echo $module_header; ?></h3></header>
    <?php echo $module_content; ?>
    <?php if (isset($module_footer)): ?>
        <footer><?php echo $module_footer; ?></footer>
    <?php endif; ?>
</article>
