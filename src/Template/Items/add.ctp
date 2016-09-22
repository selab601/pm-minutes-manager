<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Minutes'), ['controller' => 'Minutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Minute'), ['controller' => 'Minutes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Responsibilities'), ['controller' => 'Responsibilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Responsibility'), ['controller' => 'Responsibilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php
            echo $this->Form->input('minute_id', ['options' => $minutes]);
            echo $this->Form->input('primary_no');
            echo $this->Form->input('item_category_id', ['options' => $itemCategories]);
            echo $this->Form->input('order_in_minute');
            echo $this->Form->input('contents');
            echo $this->Form->input('revision');
            echo $this->Form->input('overed_at', ['empty' => true]);
            echo $this->Form->input('created_at', ['empty' => true]);
            echo $this->Form->input('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
