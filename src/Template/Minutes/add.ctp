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
                    $project_id = $projects_users[0]->project->id;
                    $project_name = $projects_users[0]->project->name;
                    echo $this->Form->input('project_id', [
                        'options' => [$project_id => $project_name],
                        'default' => $project_name,
                        'readonly' => true,
                    ]);
                    echo $this->Form->input('name');
                    echo $this->Form->input('holded_place');

                    $now = new \DateTime();
                    echo $this->Form->input('holded_at', [
                        'default' => $now->format('Y-m-d H:i:s'),
                    ]);

                    $users_array = [];
                    foreach ($projects_users as $projects_user) {
                        $user = $projects_user->toArray()["user"];
                        $users_array[$projects_user->id] =
                            $user["last_name"] . " " . $user["first_name"];
                    }
                    echo $this->Form->input('projects_users._ids', [
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
