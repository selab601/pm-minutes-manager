<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?php
            $this->Form->templates([
                'inputContainer' => '<div class="form-container-fields-field">{{content}}</div>',
                'input' => '<input class="form-container-fields-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
            ]);
            $users_array = [];
            $checked_users_array = [];
            foreach ($users as $user) {
                $users_array[$user->projects_user_id] = $user['last_name']." ".$user['first_name'];
                if ($user->has_responsibility) {
                    array_push($checked_users_array, $user->projects_user_id);
                }
            }
        ?>

        <div class="form-container-wrapper">
            <?= $this->Form->create($item, ['class'=>'form-container', 'id'=>'add-item-container']) ?>
            <fieldset class="form-container-fields">
                <legend>案件を編集する</legend>
                <?php
                    echo $this->Form->input('primary_char', [
                        'options' => [
                            "高" => "高",
                            "中" => "中",
                            "低" => "低"
                        ],
                        'label' => '優先度 : ',
                    ]);
                    echo $this->Form->input('item_category_id', ['options' => $itemCategories, 'label' => '案件種別 : ']);
                    echo $this->Form->input('contents', [
                        'label' => '議事内容 : ',
                        'type' => 'textarea',
                    ]);
                    echo $this->Form->input('overed_at', ['empty' => true, 'label' => '期限 : ']);
                ?>
                <div class="checkbox-form" id="item-checkbox-form">
                    <label>担当者 : </label>
                    <div class="checkbox-form-input-wrapper">
                        <div class="checkbox-form-input">
                            <?php
                                echo $this->Form->input('projects_users._ids', [
                                    'options' => $users_array,
                                    'multiple' => 'checkbox',
                                    'checked' => true,
                                    'default' => $checked_users_array,
                                    'label' => false,
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-container-footer">
                <?= $this->Form->button("決定") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
