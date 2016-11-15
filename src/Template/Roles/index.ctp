<div class="container">
    <div class="roles index large-9 medium-8 columns content">
        <h3><?= __('担当種別') ?></h3>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id', ['label'=>'ID']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name', ['label'=>'担当名']) ?></th>
                    <th scope="col" class="actions"><?= __('操作') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= $this->Number->format($role->id) ?></td>
                        <td><?= h($role->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('編集'), ['action' => 'edit', $role->id]) ?>
                            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <center>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('前')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('次') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </center>
    </div>
</div>
