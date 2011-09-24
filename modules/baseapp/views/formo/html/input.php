<?php echo $open; ?>
<?php echo $label; ?>
<span class="field">
    <?php if ($this->editable() === TRUE): ?>
        <?php echo $this->add_class('input')->html(); ?>
    <?php else: ?>
        <span><?php echo $this->val(); ?></span>
<?php endif; ?>
</span>
<?php echo $message; ?>
<?php echo $close; ?>