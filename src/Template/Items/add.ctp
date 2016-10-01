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
        $this->Form->templates([
            'inputContainer' => '<div class="form-container-field">{{content}}</div>',
            'input' => '<input class="form-container-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
            'textarea' => '<div class="form-container-field-input"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
            'select' => '<div class="form-container-field-input"><select name="{{name}}"{{attrs}}>{{content}}</select></div>',
        ]);
        $users_array = [];
        foreach ($users as $user) {
            $users_array[$user->projects_user_id] = $user['last_name']." ".$user['first_name'];
        }
    ?>

    <div class="form-container-wrapper">
        <?php
            echo $this->Form->create($item, [
                'class'=>'form-container add-item',
            ]);
        ?>
        <fieldset>
            <legend>案件を追加する</legend>
            <div class="form-container-fields add-item">
                <?php
                    echo $this->Form->input('primary_char', [
                        'options' => [
                            "高" => "高",
                            "中" => "中",
                            "低" => "低"
                        ],
                        'default' => "中",
                        'label' => '優先度 : ',
                    ]);
                    echo $this->Form->input('item_category_id', [
                        'options' => $itemCategories,
                        'label' => '案件種別 : '
                    ]);
                    echo $this->Form->input('contents', [
                        'label'=>'議事内容 : ',
                        'type'=>'textarea',
                    ]);
                    echo $this->Form->input('overed_at', [
                        'empty' => true,
                        'label'=>'期限 : ',
                        'type'=>'text',
                        'id'=>'datepicker',
                    ]);
                ?>
                <div class="checkbox-form add-item">
                    <label>担当者 : </label>
                    <div class="checkbox-form-input-wrapper">
                        <div class="checkbox-form-input">
                            <?php
                                echo $this->Form->input('users._ids', [
                                    'options' => $users_array,
                                    'multiple' => 'checkbox',
                                    'label' => false,
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("決定") ?>
        </div>
    </div>
</body>
</html>
