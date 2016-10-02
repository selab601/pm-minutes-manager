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
        $( function() {
            $( "#datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
        } );
    </script>
    <body>
        <?= $this->element('header') ?>

        <?php
            $users_array = [];
            $checked_users_array = [];
            foreach ($users as $user) {
                $users_array[$user->projects_user_id] = $user['last_name']." ".$user['first_name'];
                if ($user->has_responsibility) {
                    array_push($checked_users_array, $user->projects_user_id);
                }
            }
            if ($item->overed_at == NULL) {
                $default_overed_at = "";
            } else {
                $default_overed_at = $item->overed_at->format('Y/m/d');
            }
        ?>

        <?= $this->element('formContainerTemplate') ?>
        <div class="form-container-wrapper">
            <?= $this->Form->create($item, ['class'=>'form-container add-item']) ?>
            <fieldset>
                <legend>案件を編集する</legend>
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
                        'value'=>$default_overed_at,
                        ]) ?>
                    <?= $this->element('checkboxForm', [
                        'label' => '担当者 : ',
                        'classes' => 'add-item',
                        'form' => $this->Form,
                        'options' => $users_array,
                        'default' => $checked_users_array,
                        ]) ?>
                </div>
            </fieldset>
            <div class="form-container-footer">
                <?= $this->Form->button("決定") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
