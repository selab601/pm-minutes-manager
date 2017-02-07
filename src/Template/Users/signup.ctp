<?= $this->assign('title', '新規登録') ?>
<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($user, ['class'=>'form-container add-user']) ?>
<?= $this->Html->script(['/util/on_focus.js'], ['block' => true]) ?>
<fieldset>
    <legend>ユーザの追加</legend>
    <div class="form-container-fields add-user">
        <?= $this->Form->input('id_string', [
            'label' => 'ID : ',
            'placeholder' => '学籍番号で登録してください',
            'id' => 'first_focus',
            ]) ?>
        <?= $this->element('nameForm', ['form' => $this->Form]) ?>
        <?= $this->Form->input('password', ['label' => 'パスワード : ',]) ?>
        <?= $this->Form->input('mail', ['label' => 'メールアドレス : ',]) ?>
    </div>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button("追加") ?>
</div>
<?= $this->Form->end() ?>
