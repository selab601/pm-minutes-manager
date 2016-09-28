<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="container">
        <?= $this->Form->create($item) ?>
        <fieldset>
            <legend><?= __('Add Item') ?></legend>
            <?php
                echo $this->Form->input('minute_id', [
                    'options' => [$minute->id => $minute->name],
                    'default' => $minute->name,
                    'readonly' => true,
                ]);
                echo $this->Form->input('primary_char', [
                    'options' => [
                        "高" => "高",
                        "中" => "中",
                        "低" => "低"
                    ],
                    'default' => "中",
                ]);
                echo $this->Form->input('item_category_id', [
                    'options' => $itemCategories
                ]);
                echo $this->Form->input('contents');
                echo $this->Form->input('overed_at', ['empty' => true]);
                $users_array = [];
                foreach ($users as $user) {
                    $users_array[$user->projects_user_id] = $user['last_name']." ".$user['first_name'];
                }
                echo $this->Form->input('users._ids', [
                    'options' => $users_array,
                    'multiple' => 'checkbox',
                ]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
    </div>
</body>
</html>
