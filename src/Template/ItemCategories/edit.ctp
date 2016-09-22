<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($itemCategory) ?>
    <fieldset>
        <legend><?= __('Edit Item Category') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('created_at', ['empty' => true]);
            echo $this->Form->input('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
