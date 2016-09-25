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
            <h3><?= __('Item Categories') ?></h3>
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itemCategories as $itemCategory): ?>
                        <tr>
                            <td><?= $this->Number->format($itemCategory->id) ?></td>
                            <td><?= h($itemCategory->name) ?></td>
                            <td><?= h($itemCategory->created_at) ?></td>
                            <td><?= h($itemCategory->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $itemCategory->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemCategory->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <center>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            </center>
        </div>
    </body>
</html>
