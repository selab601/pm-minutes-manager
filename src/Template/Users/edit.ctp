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
            <div class="users form large-9 medium-8 columns content">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend><?= __('Edit User') ?></legend>
                    <?php
                        echo $this->Form->input('id_string');
                        echo $this->Form->input('last_name');
                        echo $this->Form->input('first_name');
                        echo $this->Form->input('password');
                        echo $this->Form->input('mail');
                        echo $this->Form->input('is_authorized');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
