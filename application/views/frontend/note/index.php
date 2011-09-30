<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<?php echo $form; ?>
<?php foreach ($notes as $note): ?>

    <h1>
        <?php echo $note->title; ?>
        &nbsp; <a href="<?php echo Route::url('default', array('controller' => 'note', 'action' => 'delete', 'id' => $note->id)) ?>" title="">x</a>
        &nbsp; <a href="<?php echo Route::url('default', array('controller' => 'note', 'action' => 'edit', 'id' => $note->id)) ?>" title="">*</a>
    </h1>
    <p>
        <?php echo $note->text; ?>
    </p>
<?php endforeach; ?>