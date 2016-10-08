<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery-ui.min.css') ?>
        <?= $this->html->css('jquery-ui.theme.min.css') ?>
        <?= $this->html->css('jquery-ui.structure.min.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>
    </head>
    <script>
        $(document).ready(function () {
            $( "#datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
            var meta_categories = <?= json_encode($item_meta_category_array) ?>;
            var categories = <?= json_encode($item_categories_array) ?>;
            $("select#meta-category").change(function() {
                $("select#category").empty();
                $.each(categories[$(this).val()], function(key, value) {
                    $("select#category").append(
                        $("<option></option>")
                            .attr("value", key)
                            .text(value));
                });
            });

            // 初期化
            $.each(categories[$("select#meta-category").val()], function(key, value) {
                $("select#category").append(
                    $("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            $('select#category option[value="'+<?= $item->item_category_id ?>+'"]')
                .attr("selected",true);
        });
    </script>
    <body>
        <?= $this->element('header') ?>

        <?= $this->element('formContainerTemplate') ?>
        <?= $this->Form->create($item, ['class'=>'form-container add-item']) ?>
        <fieldset>
            <legend>案件を編集する</legend>
            <p>
                案件項目を「タスク」に設定した場合には，「期限」を必ず設定するようにしてください．<br>
                「期限」を設定しない場合，現在のシステムの使用上「フォロー」を行うことができません．<br>
                また，「フォロー」済みの案件の期限，担当者は変更できません．
            </p>
            <div class="form-container-fields add-item">
                <?= $this->Form->input('primary_char', [
                    'options' => [
                        "-" => "-",
                        "高" => "高",
                        "中" => "中",
                        "低" => "低"
                    ],
                    'default' => "中",
                    'label' => '優先度 : ',
                    ]) ?>
                <?= $this->Form->input('item_meta_category_id', [
                    'options' => $item_meta_category_array,
                    'label' => '案件項目 : ',
                    'id' => 'meta-category',
                    'default' => $item->item_meta_category_id,
                    ]) ?>
                <?= $this->Form->input('item_category_id', [
                    'label' => '案件種別 : ',
                    'id' => 'category'
                    ]) ?>
                <?= $this->Form->input('contents', [
                    'label'=>'議事内容 : ',
                    'type'=>'textarea',
                    ]) ?>
                <?= $this->Form->input('overed_at', [
                    'empty' => true,
                    'label'=>'期限 : ',
                    'type'=>'text',
                    'id'=>'datepicker',
                    'disabled' => $item->is_followed,
                    'value'=>$default_overed_at,
                    ]) ?>
                <?php
                    if (!$item->is_followed) {
                        echo $this->element('checkboxForm', [
                            'name' => 'projects_users._ids',
                            'label' => '担当者 : ',
                            'classes' => 'add-item',
                            'form' => $this->Form,
                            'options' => $users_array,
                            'default' => $checked_users_array,
                        ]);
                    }
                ?>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("決定") ?>
        </div>
        <?= $this->Form->end() ?>
    </body>
</html>
