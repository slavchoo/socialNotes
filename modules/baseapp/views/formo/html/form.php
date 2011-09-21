<div class="module_content">
    <?php echo $this->open(); ?>
    <?php if ($error = $this->error() AND $error !== TRUE): ?>
        <span class="error-message"><?php echo $this->error(); ?></span>
    <?php endif; ?>
    <?php foreach ($this->fields() as $_field): ?>
        <?php if ($_field->get_driver() !== 'submit')
            echo $_field->render(); ?>
    <?php endforeach; ?>
<?php echo $this->close(); ?>
</div>
<footer>
    <div class="submit_link">
        <?php foreach ($this->fields() as $_field): ?>
            <?php if ($_field->get_driver() === 'submit')
                echo $_field->render(); ?>
        <?php endforeach; ?>
    </div>
</footer>