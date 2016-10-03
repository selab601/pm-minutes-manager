<li>
    <div class="revision-date">
        <?= $date ?>
        <?php
            $now = new DateTime();
            if ( (int)$now->diff(new DateTime($date))->format("%a") <= 7 ) {
                echo "<span class=\"new\">New!!</span>";
            }
        ?>
    </div>
    <div class="revision-contents">
        <ul>
            <?php
                foreach($contents as $content) {
                    echo "<li>";
                    echo $content;
                    echo "</li>";
                }
            ?>
        </ul>
    </div>
</li>
