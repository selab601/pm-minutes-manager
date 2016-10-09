<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="itemCategories index large-9 medium-8 columns content">
                <h3><?= __('Item Categories') ?></h3>
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id', ['label'=>'ID']) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name', ['label'=>'案件種別名']) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('item_meta_category_id', ['label'=>'案件大項目']) ?></th>
                            <th scope="col" class="actions"><?= __('操作') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itemCategories as $itemCategory): ?>
                            <tr>
                                <td><?= $this->Number->format($itemCategory->id) ?></td>
                                <td><?= h($itemCategory->name) ?></td>
                                <td><?= $itemCategory->has('item_meta_category') ? $this->Html->link($itemCategory->item_meta_category->name, ['controller' => 'ItemMetaCategories', 'action' => 'view', $itemCategory->item_meta_category->id]) : '' ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $itemCategory->id]) ?>
                                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $itemCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('前')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('次') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            </div>
        </div>
    </body>
</html>
