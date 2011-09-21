<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<?php
if (!is_array($container_content)) {
    $container_content = (array) $container_content;
}
?>
<div class="tab_container">
    <?php foreach ($container_content as $key => $content): ?>
        <div id="tab<?php echo $key + 1; ?>" class="tab_content">
            <?php echo $content; ?>
        </div>
    <?php endforeach; ?>
</div>