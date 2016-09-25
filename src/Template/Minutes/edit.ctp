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
            <?= $this->Form->create($minute) ?>
            <fieldset>
                <legend><?= __('Edit Minute') ?></legend>
                <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('holded_place');
                    echo $this->Form->input('holded_at', ['empty' => true]);
                    echo $this->Form->input('is_examined');
                    echo $this->Form->input('is_approved');
                    echo $this->Form->input('examined_at', ['empty' => true]);
                    echo $this->Form->input('approved_at', ['empty' => true]);
                    echo $this->Form->input('is_deleted');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
