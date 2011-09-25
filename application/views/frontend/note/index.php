<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<?php foreach ($notes as $note): ?>

    <h1><?php echo $note->title; ?></h1>
    <p>
        <?php echo $note->text; ?>
    </p>
<?php endforeach; ?>
