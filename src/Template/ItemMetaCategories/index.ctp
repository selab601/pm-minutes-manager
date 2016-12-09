<?= $this->assign('title', '管理者画面') ?>
<div class="container">
    <div class="itemMetaCategories index large-9 medium-8 columns content">
        <h3><?= __('案件大項目') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id', ['label'=>'ID']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name', ['label'=>'案件大項目名']) ?></th>
                    <th scope="col" class="actions"><?= __('操作') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itemMetaCategories as $itemMetaCategory): ?>
                    <tr>
                        <td><?= $this->Number->format($itemMetaCategory->id) ?></td>
                        <td><?= h($itemMetaCategory->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('編集'), ['action' => 'edit', $itemMetaCategory->id]) ?>
                            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $itemMetaCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemMetaCategory->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('次')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('前') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
