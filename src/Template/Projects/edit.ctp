<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="projects form large-9 medium-8 columns content">
                <?= $this->Form->create($project) ?>
                <fieldset>
                    <legend><?= __('Edit Project') ?></legend>
                    <?php
                        echo $this->Form->input('name');
                        echo $this->Form->input('budget');
                        echo $this->Form->input('customer_name');
                        echo $this->Form->input('started_at');
                        echo $this->Form->input('finished_at');
                        echo $this->Form->input('users._ids', ['options' => $users]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
