<?php
    $i = 0;
    if (!isset($classes)) { $classes = ""; }
    if (!isset($participation_classes)) { $participation_classes = ""; }
    foreach ($users as $user) {
        if ($i%$col_num == 0) { echo "<div class='user-table-row'>"; }

        if (isset($add_participation) && $add_participation == true ) {
            echo "<div class=\"user-table-row-elem td ".$participation_classes."\">".$user['participation']."</div>";
        }
        if (isset($add_role) && $add_role == true ) {
            echo "<div class=\"user-table-row-elem td ".$role_classes."\">".$user['role']."</div>";
        }
        echo "<div class=\"user-table-row-elem td ".$classes."\">".$user['name']."</div>";

        if ($i%$col_num == $col_num - 1) { echo "</div>"; }
        $i++;
    }

    for ($j = $i; $j%$col_num != 0; $j++) {
        if (isset($add_participation) && $add_participation == true) {
            echo "<div class=\"user-table-row-elem td ".$participation_classes."\"> - </div>";
        }
        if (isset($add_role) && $add_role == true) {
            echo "<div class=\"user-table-row-elem td ".$role_classes."\"> - </div>";
        }
        echo "<div class=\"user-table-row-elem td ".$classes."\"> - </div>";
        if ($j%$col_num == $col_num-1) { echo "</div>"; }
    }
?>
