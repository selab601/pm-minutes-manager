<?= $this->assign('title', '管理者画面') ?>
<div class="container">
    <h3>登録済みユーザ一覧</h3>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', ['label'=>'No']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_string', ['label'=>'ID']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('full_name', ['label'=>'名前']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail', ['label'=>'メール']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_authorized', ['label'=>'権限']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at', ['label'=>'作成日']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at', ['label'=>'更新日']) ?></th>
                <th scope="col" class="actions"><?= __('操作') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->id_string) ?></td>
                    <td><?= h($user->full_name) ?></td>
                    <td><?= h($user->mail) ?></td>
                    <td><?= h($user->is_authorized) ?></td>
                    <td><?= h($user->created_at) ?></td>
                    <td><?= h($user->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('閲覧'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
