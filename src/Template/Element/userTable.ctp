<?php
    $i = 0;
    if (!isset($classes)) { $classes = ""; }
    if (!isset($participation_classes)) { $participation_classes = ""; }
    foreach ($users as $user) {
        if ($i%$col_num == 0) { echo "<tr>"; }

        if (isset($add_participation) && $add_participation == true ) {
            echo "<td class=\"".$participation_classes."\">".$user['participation']."</td>";
        }
        if (isset($add_role) && $add_role == true ) {
            echo "<td class=\"".$role_classes."\">".$user['role']."</td>";
        }
        echo "<td class=\"".$classes."\">".$user['name']."</td>";

        if ($i%$col_num == $col_num - 1) { echo "</tr>"; }
        $i++;
    }

    for ($j = $i; $j%$col_num != 0; $j++) {
        if (isset($add_participation) && $add_participation == true) {
            echo "<td class=\"".$participation_classes."\"> - </td>";
        }
        if (isset($add_role) && $add_role == true) {
            echo "<td class=\"".$role_classes."\"> - </td>";
        }
        echo "<td class=\"".$classes."\"> - </td>";
        if ($j%$col_num == $col_num-1) { echo "</tr>"; }
    }
?>
