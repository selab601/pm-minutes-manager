<?= $this->assign('title', '管理者画面') ?>
<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($itemMetaCategory, ['class'=>'form-container item-category']) ?>
<div class="itemCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($itemCategory) ?>
    <fieldset>
        <legend><?= __('案件項目の追加') ?></legend>
        <?= $this->Form->input('name', ['label'=>'案件項目名 : ']) ?>
        <?= $this->Form->input('item_meta_category_id', ['options' => $itemMetaCategories, 'label'=>'案件大項目 : ']) ?>
    </fieldset>
    <div class="form-container-footer">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
