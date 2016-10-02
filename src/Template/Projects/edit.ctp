<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery-ui.min.css') ?>
        <?= $this->html->css('jquery-ui.theme.min.css') ?>
        <?= $this->html->css('jquery-ui.structure.min.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>
        <?= $this->html->script(['toggleRoleList.js']) ?>
        <script>
            $(document).ready(function () {
                toggleRoleList(jQuery, '<?= $roles ?>', '<?= json_encode($members) ?>');
                $("#datepicker1").datepicker({dateFormat: 'yy/mm/dd'});
                $("#datepicker2").datepicker({dateFormat: 'yy/mm/dd'});
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?php
            $users_array = [];
            foreach ($users as $user) {
                $users_array[$user->id] = $user->last_name." ".$user->first_name;
            }
            $checked_users_array = [];
            foreach ($members as $member) {
                array_push($checked_users_array, $member->user->id);
            }
            $started_at = is_object($project->started_at) ? $project->started_at->format('Y/m/d') : $project->started_at;
            $finished_at = is_object($project->finished_at) ? $project->finished_at->format('Y/m/d') : $project->finished_at;
        ?>

        <?= $this->element('formContainerTemplate') ?>
        <div class="form-container-wrapper">
            <?= $this->Form->create($project, ['class'=>'form-container add-project']); ?>
            <fieldset>
                <legend>プロジェクトを編集する</legend>
                <div class="form-container-fields add-project">
                    <?= $this->Form->input('name', ['label' => 'プロジェクト名 : ']) ?>
                    <?= $this->Form->input('budget', ['label' => '予算 : ']) ?>
                    <?= $this->Form->input('customer_name', ['label' => '顧客名 : ']) ?>
                    <?= $this->Form->input('started_at', [
                        'label' => '開始期間 : ',
                        'type'=>'text',
                        'id'=>'datepicker1',
                        'value'=>$started_at,
                        ]) ?>
                    <?= $this->Form->input('finished_at', [
                        'label' => '終了期間 : ',
                        'type'=>'text',
                        'id'=>'datepicker2',
                        'value'=>$finished_at,
                        ]) ?>
                    <?= $this->element('checkboxForm', [
                        'name' => 'users._ids',
                        'label' => '参加者 : ',
                        'classes' => 'add-project',
                        'form' => $this->Form,
                        'options' => $users_array,
                        'default' => $checked_users_array,
                        ]) ?>
                </div>
            </fieldset>
            <div class="form-container-footer">
                <?= $this->Form->button("決定") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
