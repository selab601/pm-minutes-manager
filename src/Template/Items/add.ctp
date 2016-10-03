<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->html->css('jquery-ui.min.css') ?>
    <?= $this->html->css('jquery-ui.theme.min.css') ?>
    <?= $this->html->css('jquery-ui.structure.min.css') ?>
    <?= $this->Html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>
</head>
<script>
    $(document).ready(function () {
        $( "#datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
        var meta_categories = <?= json_encode($itemMetaCategoryArray) ?>;
        var categories = <?= json_encode($itemCategoriesArray) ?>;
        $("select#meta-category").change(function() {
            $("select#category").empty();
            $.each(categories[$(this).val()], function(key, value) {
                $("select#category").append(
                    $("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
        });
    });
</script>
<body>
    <?= $this->element('header') ?>

    <?php
        $users_array = [];
        foreach ($users as $user) {
            $users_array[$user->projects_user_id] = $user['last_name']." ".$user['first_name'];
        }
    ?>

    <?= $this->element('formContainerTemplate') ?>
    <?= $this->Form->create($item, ['class'=>'form-container add-item']) ?>
    <fieldset>
        <legend>案件を追加する</legend>
        <div class="form-container-fields add-item">
            <?= $this->Form->input('primary_char', [
                'options' => [
                    '-' => "-",
                    "高" => "高",
                    "中" => "中",
                    "低" => "低"
                ],
                'default' => "中",
                'label' => '優先度 : ',
                'value' => "-",
                ]) ?>
            <?= $this->Form->input('item_meta_category_id', [
                'options' => $itemMetaCategoryArray,
                'label' => '案件項目 : ',
                'id' => 'meta-category'
                ]) ?>
            <?= $this->Form->input('item_category_id', [
                'options' => $itemCategoriesArray[1],
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
                    ]) ?>
            <?= $this->element('checkboxForm', [
                'name' => 'projects_users._ids',
                'label' => '担当者 : ',
                'classes' => 'add-item',
                'form' => $this->Form,
                'options' => $users_array,
                'default' => '',
                ]) ?>
        </div>
    </fieldset>
    <div class="form-container-footer">
        <?= $this->Form->button("決定") ?>
    </div>
</body>
</html>
