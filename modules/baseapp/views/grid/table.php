<?php
if (Kohana::$profiling === TRUE) {
    $benchmark = Profiler::start('grid', 'render');
}

echo '<table class="tablesorter" cellspacing="0">';

echo '<thead>';
echo '    <tr>';
foreach ($columns as $column) {
    if (get_class($column) !== 'Grid_Column_Action') {
        echo '<th>' . $column->render_header() . '</th>';
    }
}

foreach ($columns as $column) {
    if (get_class($column) === 'Grid_Column_Action') {
        echo '<th>';
        echo $column->render_header();
        echo '</th>';
        break;
    }
}


echo '    </tr>';
echo '</thead>';

echo '<tbody>';
foreach ($dataset as $data) {
    echo "\t<tr>";
    $actions = array();
    foreach ($columns as $column) {
        if (get_class($column) !== 'Grid_Column_Action') {
            echo "\t\t<td>" . $column->render($data) . '</td>';
        } else {
            $actions[] = $column;
        }
    }

    if (count($actions)) {
        echo "\t\t<td>";
        foreach ($actions as $action) {
            echo $action->render($data) . "&nbsp";
        }
        echo '</td>';
    }
    echo "\t</tr>";
}
echo '</tbody>';

echo '</table>';
?> 
<footer>
    <?php echo View::factory('admin/template/container/table/footer', array('links' => $links)) ?>
</footer>
<?php
if (isset($benchmark)) {
    Profiler::stop($benchmark);
}
