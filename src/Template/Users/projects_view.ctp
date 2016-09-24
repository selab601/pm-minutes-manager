<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="related">
                <h4>あなたの参加するプロジェクト一覧です</h4>
                <?php if (!empty($user->projects)): ?>
                    <table class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th scope="col"><?= __('Budget') ?></th>
                            <th scope="col"><?= __('Customer Name') ?></th>
                            <th scope="col"><?= __('Started At') ?></th>
                            <th scope="col"><?= __('Finished At') ?></th>
                            <th scope="col"><?= __('Created At') ?></th>
                            <th scope="col"><?= __('Updated At') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->projects as $projects): ?>
                            <tr>
                                <td><?= h($projects->name) ?></td>
                                <td><?= h($projects->budget) ?></td>
                                <td><?= h($projects->customer_name) ?></td>
                                <td><?= h($projects->started_at) ?></td>
                                <td><?= h($projects->finished_at) ?></td>
                                <td><?= h($projects->created_at) ?></td>
                                <td><?= h($projects->updated_at) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
            <center>
                <?=
                    $this->Html->link('新規作成', [
                        'controller'=>'Projects',
                        'action'=>'add'
                    ])
                ?>
            </center>
        </div>
    </body>
</html>
