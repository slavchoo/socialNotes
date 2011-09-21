<?php defined('SYSPATH') or die('No direct script access.'); ?>

<html>
    <head>
        <title><?php echo $title?></title>
        <?php echo Static_Hack::getInstance()->getAll() ?>
        <?php echo Static_Css::getInstance()->getAll() ?>
        <?php echo Static_Js::getInstance()->getAll() ?>
    </head>
<?php echo $content; ?>
</html>