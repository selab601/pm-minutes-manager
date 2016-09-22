<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Minutes'), ['controller' => 'Minutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Minute'), ['controller' => 'Minutes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Responsibilities'), ['controller' => 'Responsibilities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Responsibility'), ['controller' => 'Responsibilities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Minute') ?></th>
            <td><?= $item->has('minute') ? $this->Html->link($item->minute->name, ['controller' => 'Minutes', 'action' => 'view', $item->minute->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Category') ?></th>
            <td><?= $item->has('item_category') ? $this->Html->link($item->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $item->item_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contents') ?></th>
            <td><?= h($item->contents) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Primary No') ?></th>
            <td><?= $this->Number->format($item->primary_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order In Minute') ?></th>
            <td><?= $this->Number->format($item->order_in_minute) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Revision') ?></th>
            <td><?= $this->Number->format($item->revision) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Overed At') ?></th>
            <td><?= h($item->overed_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($item->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($item->updated_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Responsibilities') ?></h4>
        <?php if (!empty($item->responsibilities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Projects User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($item->responsibilities as $responsibilities): ?>
            <tr>
                <td><?= h($responsibilities->id) ?></td>
                <td><?= h($responsibilities->item_id) ?></td>
                <td><?= h($responsibilities->projects_user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Responsibilities', 'action' => 'view', $responsibilities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Responsibilities', 'action' => 'edit', $responsibilities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Responsibilities', 'action' => 'delete', $responsibilities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $responsibilities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
