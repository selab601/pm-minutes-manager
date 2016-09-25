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
                <legend><?= __('Add Minute') ?></legend>
                <?php
                    echo $this->Form->input('project_id', [
                        'options' => [$project->id => $project->name],
                        'default' => $project->name,
                        'readonly' => true,
                    ]);
                    echo $this->Form->input('name');
                    echo $this->Form->input('holded_place');

                    $now = new \DateTime();
                    echo $this->Form->input('holded_at', [
                        'default' => $now->format('Y-m-d H:i:s'),
                    ]);

                    $users_array = [];
                    foreach ($project->users as $user) {
                        $users_array[$user['id']] = $user['last_name'] . " " . $user['first_name'];
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
