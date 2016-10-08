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
                toggleRoleList(jQuery, '<?= $roles ?>', <?= json_encode($auth_user) ?>);
                $("#datepicker1").datepicker({dateFormat: 'yy/mm/dd'});
                $("#datepicker2").datepicker({dateFormat: 'yy/mm/dd'});
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?= $this->element('formContainerTemplate') ?>
        <?= $this->Form->create($project, ['class'=>'form-container add-project']); ?>
        <fieldset>
            <legend>プロジェクトを追加する</legend>
            <div class="form-container-fields add-project">
                <?= $this->Form->input('name', ['label' => 'プロジェクト名 : ']) ?>
                <?= $this->Form->input('budget', ['label' => '予算 : ']) ?>
                <?= $this->Form->input('customer_name', ['label' => '顧客名 : ']) ?>
                <?= $this->element('spanForm', [
                    'form' => $this->form,
                    ]) ?>
                <?= $this->element('checkboxForm', [
                    'name' => 'users._ids',
                    'label' => '参加者 : ',
                    'classes' => 'add-project',
                    'form' => $this->Form,
                    'options' => $users_array,
                    'default' => [$this->request->session()->read('Auth.User.id')],
                    ]) ?>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("決定") ?>
        </div>
        <?= $this->Form->end() ?>
    </body>
</html>
