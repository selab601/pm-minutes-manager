<?php
    $i = 0;
    if (!isset($classes)) { $classes = ""; }
    if (!isset($participation_classes)) { $participation_classes = ""; }
    foreach ($users as $user) {
        if ($i%$col_num == 0) { echo "<tr>"; }

        if ($add_participation) {
            echo "<td class=\"".$participation_classes."\">".$user['participation']."</td>";
        }
        echo "<td class=\"".$classes."\">".$user['name']."</td>";

        if ($i%$col_num == $col_num - 1) { echo "</tr>"; }
        $i++;
    }

    for ($j = $i; $j%$col_num != 0; $j++) {
        if ($add_participation) {
            echo "<td class=\"".$participation_classes."\"> - </td>";
        }
        echo "<td class=\"".$classes."\"> - </td>";
        if ($j%$col_num == $col_num-1) { echo "</tr>"; }
    }
?>
