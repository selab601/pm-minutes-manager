<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="contents">

            <div class="side-contents">

                <h4>プロジェクト詳細</h4>

                <div>
                    <table class="table">
                        <tr>
                            <th scope="row">プロジェクト名</th>
                            <td><?= h($project->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">顧客名</th>
                            <td><?= h($project->customer_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">予算</th>
                            <td><?= $this->Number->format($project->budget) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">期間</th>
                            <td><?= h($project->started_at." 〜 ".$project->finished_at) ?></td>
                        </tr>
                    </table>
                </div>

                <div>
                    <?php if (!empty($projects_users)): ?>
                        <table class="table">
                            <tr><th colspan="3">参加メンバー</th></tr>
                            <?php
                                $users = [];
                                foreach ($projects_users as $projects_user) {
                                    $user;
                                    $user['name'] = $projects_user->user->last_name . " " . $projects_user->user->first_name;
                                    array_push($users, $user);
                                }
                            ?>
                            <?= $this->element('userTable', [
                                "users"=>$users,
                                "add_participation"=>false,
                                "col_num"=>2,
                                ]) ?>
                        </table>
                    <?php endif; ?>
                </div>

            </div>

            <div class="main-contents">

                <h4>議事録一覧</h4>

                <?php if (!empty($project->minutes)): ?>
                    <table class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col">議事録名</th>
                            <th scope="col">開催場所</th>
                            <th scope="col">開催日</th>
                            <th scope="col">審査</th>
                            <th scope="col">承認</th>
                            <th scope="col">削除</th>
                            <th scope="col"></th>
                        </tr>
                        <?php foreach ($project->minutes as $minutes): ?>
                            <tr>
                                <td><?= h($minutes->name) ?></td>
                                <td><?= h($minutes->holded_place) ?></td>
                                <td><?= h($minutes->holded_at) ?></td>
                                <td><?= h($minutes->examined_at) ?></td>
                                <td><?= h($minutes->approved_at) ?></td>
                                <td>
                                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Minutes', 'action' => 'delete', $minutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minutes->id)]) ?>
                                </td>
                                <td class="actions">
                                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Minutes', 'action' => 'view', $minutes->id]) ?>
                                    <?= $this->Html->link(__('編集'), ['controller' => 'Minutes', 'action' => 'edit', $minutes->id]) ?>
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
