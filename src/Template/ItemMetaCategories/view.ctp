<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Meta Category'), ['action' => 'edit', $itemMetaCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Meta Category'), ['action' => 'delete', $itemMetaCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemMetaCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Meta Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Meta Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemMetaCategories view large-9 medium-8 columns content">
    <h3><?= h($itemMetaCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemMetaCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemMetaCategory->id) ?></td>
        </tr>
    </table>
</div>
