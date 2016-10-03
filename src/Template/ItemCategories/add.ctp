<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Meta Categories'), ['controller' => 'ItemMetaCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Meta Category'), ['controller' => 'ItemMetaCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($itemCategory) ?>
    <fieldset>
        <legend><?= __('Add Item Category') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('item_meta_category_id', ['options' => $itemMetaCategories]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
