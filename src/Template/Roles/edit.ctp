<?= $this->assign('title', '管理者画面') ?>
<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($role, ['class'=>'form-container role']) ?>
<fieldset>
    <legend><?= __('担当種別の編集') ?></legend>
    <?= $this->Form->input('name', ['label'=>'担当種別名 : ']) ?>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button(__('編集')) ?>
</div>
<?= $this->Form->end() ?>
