<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Minutes'), ['controller' => 'Minutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Minute'), ['controller' => 'Minutes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Responsibilities'), ['controller' => 'Responsibilities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Responsibility'), ['controller' => 'Responsibilities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items index large-9 medium-8 columns content">
    <h3><?= __('Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('minute_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('primary_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_in_minute') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contents') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revision') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overed_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $this->Number->format($item->id) ?></td>
                <td><?= $item->has('minute') ? $this->Html->link($item->minute->name, ['controller' => 'Minutes', 'action' => 'view', $item->minute->id]) : '' ?></td>
                <td><?= $this->Number->format($item->primary_no) ?></td>
                <td><?= $item->has('item_category') ? $this->Html->link($item->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $item->item_category->id]) : '' ?></td>
                <td><?= $this->Number->format($item->order_in_minute) ?></td>
                <td><?= h($item->contents) ?></td>
                <td><?= $this->Number->format($item->revision) ?></td>
                <td><?= h($item->overed_at) ?></td>
                <td><?= h($item->created_at) ?></td>
                <td><?= h($item->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $item->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
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
