<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($itemMetaCategory, ['class'=>'form-container item-meta-category']) ?>
<fieldset>
    <legend><?= __('案件大項目の編集') ?></legend>
    <?= $this->Form->input('name', ['label'=>'案件大項目名 : ']) ?>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button(__('編集')) ?>
</div>
<?= $this->Form->end() ?>
