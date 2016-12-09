<?= $this->assign('title', 'プロジェクト') ?>
<div class="container">
    <h3>登録済みのプロジェクト</h3>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', ['label'=>'No']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('name', ['label'=>'プロジェクト名']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget', ['label'=>'予算']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name', ['label'=>'顧客名']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('started_at', ['label'=>'開始日']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('finished_at', ['label'=>'終了日']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at', ['label'=>'作成日']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at', ['label'=>'更新日']) ?></th>
                <th scope="col" class="actions"><?= __('操作') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= $this->Number->format($project->id) ?></td>
                    <td><?= h($project->name) ?></td>
                    <td><?= $this->Number->format($project->budget) ?></td>
                    <td><?= h($project->customer_name) ?></td>
                    <td><?= isset($project->started_at) ? h($project->started_at->format('Y/m/d')) : "" ?></td>
                    <td><?= isset($project->finished_at) ? h($project->finished_at->format('Y/m/d')) : "" ?></td>
                    <td><?= h($project->created_at->format('Y/m/d H:i')) ?></td>
                    <td><?= h($project->updated_at->format('Y/m/d H:i')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('閲覧'), ['action' => 'view', $project->id]) ?>
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $project->id]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
