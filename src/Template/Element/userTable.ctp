<?php
    $i = 0;
    foreach ($users as $user) {
        if ($i%$col_num == 0) { echo "<tr>"; }

        if ($add_participation) {
            echo "<td><center>".$user['participation']."</center></td>";
        }
        echo "<td>".$user['name']."</td>";

        if ($i%$col_num == $col_num - 1) { echo "</tr>"; }
        $i++;
    }

    for ($j = $i; $j%$col_num != 0; $j++) {
        if ($add_participation) {
            echo "<td><center> - </center></td>";
        }
        echo "<td> --------------------- </td>";
        if ($j%$col_num == $col_num-1) { echo "</tr>"; }
    }
?>
