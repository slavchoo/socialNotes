<div class="submit_link">
    <?php
    echo count($links) > 1 ? '<ul>' : null;
    foreach ($links as $link) {
        echo count($links) > 1 ? '<li>' : null;
        echo $link;
        echo count($links) > 1 ? '</li>' : null;
    }
    echo count($links) > 1 ? '</ul>' : null;
    ?>
</div>