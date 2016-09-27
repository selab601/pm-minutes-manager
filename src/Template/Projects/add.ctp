<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
        <?= $this->html->script(['toggleRoleList.js']) ?>
        <script>
            $(document).ready(function () {
                toggleRoleList(jQuery, '<?= $roles ?>', null);
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="projects form large-9 medium-8 columns content">
                <?= $this->Form->create($project) ?>
                <fieldset>
                    <legend><?= __('Add Project') ?></legend>
                    <?php
                        echo $this->Form->input('name');
                        echo $this->Form->input('budget');
                        echo $this->Form->input('customer_name');
                        echo $this->Form->input('started_at');
                        echo $this->Form->input('finished_at');

                        $users_array = [];
                        foreach ($users as $user) {
                            $users_array[$user['id']] = $user['last_name'] . " " . $user['first_name'];
                        }
                        echo $this->Form->input('users._ids', [
                            'options' => $users_array,
                            'templates' => [
                                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                'checkboxFormGroup' => '{{label}}',
                                'inputContainer' => '<div class="form-group role-checkbox {{type}}{{required}}">{{content}}</div>',
                            ],
                            'multiple' => 'checkbox',
                        ]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
