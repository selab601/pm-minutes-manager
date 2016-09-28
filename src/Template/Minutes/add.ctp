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
            foreach ($projects_users as $projects_user) {
                $user = $projects_user->toArray()["user"];
                $users_array[$projects_user->id] =
                    $user["last_name"] . " " . $user["first_name"];
            }
        ?>

        <div class="form-container-wrapper">
            <?= $this->Form->create('Minute', ['class'=>'form-container', 'id'=>'add-minute-container']) ?>
            <fieldset class="form-container-fields">
                <legend>議事録の追加</legend>
                <?php
                    echo $this->Form->input('name', ['label'=>'議事録名 : ']);
                    echo $this->Form->input('holded_place', ['label'=>'開催場所 : ']);

                    $now = new \DateTime();
                    echo $this->Form->input('holded_at', [
                        'type' => 'datetime',
                        'default' => $now->format('Y-m-d H:i:s'),
                        'label' => '開催時刻 : ',
                    ]);

                ?>
                <div class="checkbox-form" id="minute-checkbox-form">
                    <label>参加者 : </label>
                    <div class="checkbox-form-input-wrapper">
                        <div class="checkbox-form-input">
                            <?php
                                echo $this->Form->input('projects_users._ids', [
                                    'options' => $users_array,
                                    'multiple' => 'checkbox',
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
                <?= $this->Form->button("追加") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
