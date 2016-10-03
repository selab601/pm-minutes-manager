<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Meta Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="itemMetaCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($itemMetaCategory) ?>
    <fieldset>
        <legend><?= __('Add Item Meta Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
