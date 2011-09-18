<?php
if (Kohana::$profiling === TRUE) {
    $benchmark = Profiler::start('grid', 'render');
}

echo count($links) > 1 ? '<ul>' : null;
foreach ($links as $link) {
    echo count($links) > 1 ? '<li>' : null;
    echo $link;
    echo count($links) > 1 ? '</li>' : null;
}
echo count($links) > 1 ? '</ul>' : null;

echo '<table class="sortable flexme">';

echo '<thead>';
echo '    <tr>';
foreach ($columns as $column) {
    echo '<th  width="100">', $column->render_header(), '</th>';
}
echo '    </tr>';
echo '</thead>';

echo '<tbody>';
foreach ($dataset as $data) {
    echo '    <tr>';
    foreach ($columns as $column) {
        echo '        <td>', $column->render($data), '</td>';
    }
    echo '    </tr>';
}
echo '</tbody>';

echo '</table>';

if (isset($benchmark)) {
    Profiler::stop($benchmark);
}
