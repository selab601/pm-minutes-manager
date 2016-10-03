<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Meta Categories'), ['controller' => 'ItemMetaCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Meta Category'), ['controller' => 'ItemMetaCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemCategories index large-9 medium-8 columns content">
    <h3><?= __('Item Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_meta_category_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemCategories as $itemCategory): ?>
            <tr>
                <td><?= $this->Number->format($itemCategory->id) ?></td>
                <td><?= h($itemCategory->name) ?></td>
                <td><?= $itemCategory->has('item_meta_category') ? $this->Html->link($itemCategory->item_meta_category->name, ['controller' => 'ItemMetaCategories', 'action' => 'view', $itemCategory->item_meta_category->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
