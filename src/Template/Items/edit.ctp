<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <?= $this->Form->create($item) ?>
            <fieldset>
                <legend><?= __('Edit Item') ?></legend>
                <?php
                    echo $this->Form->input('primary_no');
                    echo $this->Form->input('item_category_id', ['options' => $itemCategories]);
                    echo $this->Form->input('order_in_minute');
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
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
