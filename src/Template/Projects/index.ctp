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
            <h3><?= __('Projects') ?></h3>
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('budget') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('started_at') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('finished_at') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= $this->Number->format($project->id) ?></td>
                            <td><?= h($project->name) ?></td>
                            <td><?= $this->Number->format($project->budget) ?></td>
                            <td><?= h($project->customer_name) ?></td>
                            <td><?= h($project->started_at) ?></td>
                            <td><?= h($project->finished_at) ?></td>
                            <td><?= h($project->created_at) ?></td>
                            <td><?= h($project->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $project->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
