<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="container">
        <div class="users form large-9 medium-8 columns content">
            <?php
                echo $this->Form->create('User');
            ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->input('id_string');
                    echo $this->Form->input('last_name');
                    echo $this->Form->input('first_name');
                    echo $this->Form->input('password');
                    echo $this->Form->input('is_authorized');
                    echo $this->Form->input('mail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</body>
</html>
