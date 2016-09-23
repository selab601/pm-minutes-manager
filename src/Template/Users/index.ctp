<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <h3><?= __('Users') ?></h3>
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('id_string') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('full_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('is_authorized') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
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
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
