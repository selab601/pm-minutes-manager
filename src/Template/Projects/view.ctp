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

            <div class="row">

                <div class="col-md-6">
                    <h3>プロジェクト詳細</h3>
                    <table class="table table-striped">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($project->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Customer Name') ?></th>
                            <td><?= h($project->customer_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Budget') ?></th>
                            <td><?= $this->Number->format($project->budget) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('期間') ?></th>
                            <td><?= h($project->started_at." 〜 ".$project->finished_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created At') ?></th>
                            <td><?= h($project->created_at) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Updated At') ?></th>
                            <td><?= h($project->updated_at) ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>参加しているユーザ</h4>
                    <?php if (!empty($projects_users)): ?>
                        <table class="table table-striped" cellpadding="0" cellspacing="0">
                            <tr>
                                <th scope="col"><?= __('Id') ?></th>
                                <th scope="col"><?= __('Name') ?></th>
                            </tr>
                            <?php foreach ($projects_users as $projects_user): ?>
                                <tr>
                                    <td><?= h($projects_user->user->id_string) ?></td>
                                    <td><?= h($projects_user->user->last_name . " " . $projects_user->user->first_name) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>

            </div>

            <div class="related">
                <h4>議事録一覧</h4>
                <?php if (!empty($project->minutes)): ?>
                    <table class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th scope="col"><?= __('Holded Place') ?></th>
                            <th scope="col"><?= __('Holded At') ?></th>
                            <th scope="col"><?= __('Created At') ?></th>
                            <th scope="col"><?= __('Updated At') ?></th>
                            <th scope="col"><?= __('Examined At') ?></th>
                            <th scope="col"><?= __('Approved At') ?></th>
                            <th scope="col"><?= __('Is Deleted') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($project->minutes as $minutes): ?>
                            <tr>
                                <td><?= h($minutes->name) ?></td>
                                <td><?= h($minutes->holded_place) ?></td>
                                <td><?= h($minutes->holded_at) ?></td>
                                <td><?= h($minutes->created_at) ?></td>
                                <td><?= h($minutes->updated_at) ?></td>
                                <td><?= h($minutes->examined_at) ?></td>
                                <td><?= h($minutes->approved_at) ?></td>
                                <td>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Minutes', 'action' => 'delete', $minutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minutes->id)]) ?>
                                </td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Minutes', 'action' => 'view', $minutes->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Minutes', 'action' => 'edit', $minutes->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                <center>
                    <?=
                        $this->Html->link('新規作成', [
                            'controller'=>'Minutes',
                            'action'=>'add',
                            $project->id
                        ])
                    ?>
                </center>
            </div>
        </div>
    </body>
</html>
