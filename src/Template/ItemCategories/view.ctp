<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Category'), ['action' => 'edit', $itemCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Category'), ['action' => 'delete', $itemCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Meta Categories'), ['controller' => 'ItemMetaCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Meta Category'), ['controller' => 'ItemMetaCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemCategories view large-9 medium-8 columns content">
    <h3><?= h($itemCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Meta Category') ?></th>
            <td><?= $itemCategory->has('item_meta_category') ? $this->Html->link($itemCategory->item_meta_category->name, ['controller' => 'ItemMetaCategories', 'action' => 'view', $itemCategory->item_meta_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($itemCategory->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Minute Id') ?></th>
                <th scope="col"><?= __('Primary Char') ?></th>
                <th scope="col"><?= __('Item Meta Category Id') ?></th>
                <th scope="col"><?= __('Item Category Id') ?></th>
                <th scope="col"><?= __('Order In Minute') ?></th>
                <th scope="col"><?= __('Contents') ?></th>
                <th scope="col"><?= __('Revision') ?></th>
                <th scope="col"><?= __('Overed At') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col"><?= __('Is Followed') ?></th>
                <th scope="col"><?= __('Followed By') ?></th>
                <th scope="col"><?= __('Followed User Name') ?></th>
                <th scope="col"><?= __('Followed At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemCategory->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->minute_id) ?></td>
                <td><?= h($items->primary_char) ?></td>
                <td><?= h($items->item_meta_category_id) ?></td>
                <td><?= h($items->item_category_id) ?></td>
                <td><?= h($items->order_in_minute) ?></td>
                <td><?= h($items->contents) ?></td>
                <td><?= h($items->revision) ?></td>
                <td><?= h($items->overed_at) ?></td>
                <td><?= h($items->created_at) ?></td>
                <td><?= h($items->updated_at) ?></td>
                <td><?= h($items->is_followed) ?></td>
                <td><?= h($items->followed_by) ?></td>
                <td><?= h($items->followed_user_name) ?></td>
                <td><?= h($items->followed_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
