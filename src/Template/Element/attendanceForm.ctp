<?php
    $attend_bg_color = "#aaffff";
    $attend_color    = "#3333ff";
    $late_bg_color   = "#ffffaa";
    $late_color      = "#aaaa00";
    $absent_bg_color = "#ffaaaa";
    $absent_color    = "#ff0000";
?>

<div class="form-container-field <?= $classes ?>">
    <div class="form-container-field-column attendance-form-column">
        <label class="form-container-field-column-label"><?= $label ?></label>
        <div class="form-container-field-column-input attendance-form-inputs-wrapper">
            <?php
                foreach ($users_array as $user_id => $user_name) {
                    echo "<div class='attendance-form-input'>";
                    echo "<label class=\"attendance-form-input-label\">";
                    echo $user_name . " : ";
                    echo "</label>";
                    echo $form->select("projects_users[_ids][".$user_id."]", [
                        [
                            'text' => '出席',
                            'value' => '○',
                            'style' => 'font-weight: bold; color: '.$attend_color.'; background: '.$attend_bg_color.';',
                        ],
                        [
                            'text' => '遅刻',
                            'value' => '△',
                            'style' => 'font-weight: bold; color: '.$late_color.'; background: '.$late_bg_color.';',
                        ],
                        [
                            'text' => '欠席',
                            'value' => '×',
                            'style' => 'font-weight: bold; color: '.$absent_color.'; background: '.$absent_bg_color.';',
                        ],
                    ],[
                        'default' => isset($defaults[$user_id]) ? $defaults[$user_id] : $default,
                        'class' => 'attendance-form-input-select',
                    ]);
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</div>

<script>
    $(".attendance-form-input-select").each(function () {
        $(this).change(function(){
            selectColor();
        })
    })

    function selectColor() {
        // 現在選択されてる項目によって色設定
        $('.attendance-form-input-select').each(function() {
            switch($(this).val()) {
                case "○":
                    $(this).css({
                        'font-weight': 'bold',
                        'color': '<?= $attend_color ?>',
                        'background': '<?= $attend_bg_color ?>',
                    });
                    break;
                case "△":
                    $(this).css({
                        'font-weight': 'bold',
                        'color': '<?= $late_color ?>',
                        'background': '<?= $late_bg_color ?>',
                    });
                    break;
                case "×":
                    $(this).css({
                        'font-weight': 'bold',
                        'color': '<?= $absent_color ?>',
                        'background': '<?= $absent_bg_color ?>',
                    });
                    break;
            }
        });
    }

    selectColor();
</script>
