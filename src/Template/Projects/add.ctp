<?= $this->assign('title', 'プロジェクト追加') ?>
<?= $this->Html->script(['/util/on_focus.js'], ['block' => true]) ?>
<?php
    // ページ固有の CSS, JS の読み込み
    $this->Html->css([
        'lib/jquery-ui.min.css',
        'lib/jquery-ui.theme.min.css',
        'lib/jquery-ui.structure.min.css',
    ], ['block' => true]);
    $this->html->script([
        'toggleRoleList.js'
    ], ['block' => true]);
?>
<script>
    $(document).ready(function () {
        toggleRoleList(jQuery, '<?= $roles ?>', <?= json_encode($auth_user) ?>);
        $("#datepicker1").datepicker({dateFormat: 'yy/mm/dd'});
        $("#datepicker2").datepicker({dateFormat: 'yy/mm/dd'});
    });
</script>

<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($project, ['class'=>'form-container add-project']); ?>
<fieldset>
    <legend>プロジェクトを追加する</legend>
    <div class="form-container-fields add-project">
        <?= $this->Form->input('name', [
            'label' => 'プロジェクト名 : ',
            'id' => 'first_focus',
            ]) ?>
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
