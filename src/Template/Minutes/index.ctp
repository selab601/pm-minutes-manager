<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Minute'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participations'), ['controller' => 'Participations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participation'), ['controller' => 'Participations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="minutes index large-9 medium-8 columns content">
    <h3><?= __('Minutes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holded_place') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holded_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revision') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_examined') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('examined_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approved_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($minutes as $minute): ?>
            <tr>
                <td><?= $this->Number->format($minute->id) ?></td>
                <td><?= $minute->has('project') ? $this->Html->link($minute->project->name, ['controller' => 'Projects', 'action' => 'view', $minute->project->id]) : '' ?></td>
                <td><?= h($minute->name) ?></td>
                <td><?= h($minute->holded_place) ?></td>
                <td><?= h($minute->holded_at) ?></td>
                <td><?= h($minute->created_at) ?></td>
                <td><?= h($minute->updated_at) ?></td>
                <td><?= $this->Number->format($minute->revision) ?></td>
                <td><?= h($minute->is_examined) ?></td>
                <td><?= h($minute->is_approved) ?></td>
                <td><?= h($minute->examined_at) ?></td>
                <td><?= h($minute->approved_at) ?></td>
                <td><?= h($minute->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $minute->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $minute->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $minute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minute->id)]) ?>
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
