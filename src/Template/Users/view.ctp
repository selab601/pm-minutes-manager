<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="users view large-9 medium-8 columns content">
                <table class="table table-striped">
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id String') ?></th>
                        <td><?= h($user->id_string) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Last Name') ?></th>
                        <td><?= h($user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('First Name') ?></th>
                        <td><?= h($user->first_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Mail') ?></th>
                        <td><?= h($user->mail) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created At') ?></th>
                        <td><?= h($user->created_at) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Updated At') ?></th>
                        <td><?= h($user->updated_at) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Is Authorized') ?></th>
                        <td><?= $user->is_authorized ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
                <div class="related">
                    <h4><?= __('Related Projects') ?></h4>
                    <?php if (!empty($user->projects)): ?>
                        <table class="table table-striped" cellpadding="0" cellspacing="0">
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
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
                                    <td><?= h($projects->id) ?></td>
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
            </div>
        </div>
    </body>
</html>
