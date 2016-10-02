<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery.datetimepicker.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery.datetimepicker.full.js', 'bootstrap.min.js']) ?>
    </head>
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
            $('#datetimepicker2').datetimepicker();
        });
    </script>
    <body>
        <?= $this->element('header') ?>

        <?php
            $users_array = [];
            foreach ($projects_users as $projects_user) {
                $user = $projects_user->toArray()["user"];
                $users_array[$projects_user->id] =
                    $user["last_name"] . " " . $user["first_name"];
            }
            $now = new \DateTime();
        ?>

        <?= $this->element('formContainerTemplate') ?>
        <?= $this->Form->create($minute, ['class'=>'form-container add-minute']); ?>
        <fieldset>
            <legend>議事録の追加</legend>
            <div class="form-container-fields add-minute">
                <?= $this->Form->input('name', ['label'=>'議事録名 : ']) ?>
                <?= $this->Form->input('holded_place', ['label'=>'開催場所 : ']) ?>
                <?= $this->Form->input('holded_at', [
                    'type' => 'datetime',
                    'default' => $now->format('Y/m/d H:i'),
                    'label' => '開催時刻 : ',
                    'type'=>'text',
                    'id'=>'datetimepicker1',
                    ]) ?>
                <?= $this->Form->input('ended_at', [
                    'type' => 'datetime',
                    'default' => $now->format('Y/m/d H:i'),
                    'label' => '終了時刻 : ',
                    'type'=>'text',
                    'id'=>'datetimepicker2',
                    ]) ?>
                <?= $this->element('checkboxForm', [
                    'name' => 'projects_users._ids',
                    'label' => '参加者 : ',
                    'classes' => 'add-minute',
                    'form' => $this->Form,
                    'options' => $users_array,
                    'default' => [$auth_projects_user->id],
                    ]) ?>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("追加") ?>
        </div>
        <?= $this->Form->end() ?>
    </body>
</html>
