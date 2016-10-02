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
    $( function() {
        $( "#datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
    } );
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
    <div class="form-container-wrapper">
        <?= $this->Form->create($item, ['class'=>'form-container add-item']) ?>
        <fieldset>
            <legend>案件を追加する</legend>
            <div class="form-container-fields add-item">
                <?= $this->Form->input('primary_char', [
                    'options' => [
                        '-' => "-".
                        "高" => "高",
                        "中" => "中",
                        "低" => "低"
                    ],
                    'default' => "中",
                    'label' => '優先度 : ',
                    'value' => "-",
                    ]) ?>
                <?= $this->Form->input('item_category_id', [
                    'options' => $itemCategories,
                    'label' => '案件種別 : '
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
    </div>
</body>
</html>
