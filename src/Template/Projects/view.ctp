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
            <div class="main-contents">

                <h4>プロジェクトの議事録一覧</h4>

                <?php if (!empty($project->minutes)): ?>
                    <table class="table minute projects-view">
                        <tr>
                            <th class="minute-table-content minute-name" scope="col">議事録名</th>
                            <th class="minute-table-content holded-at">開催日</th>
                            <th class="minute-table-content examined-at" scope="col">審査</th>
                            <th class="minute-table-content approved-at" scope="col">承認</th>
                            <th class="minute-table-content is-deletable" scope="col">削除</th>
                            <th class="minute-table-content action" scope="col"></th>
                        </tr>
                        <?php foreach ($project->minutes as $minutes): ?>
                            <tr>
                                <td class="minute-table-content minute-name">
                                    <?= h($minutes->name) ?>
                                </td>
                                <td class="minute-table-content holded-at">
                                    <?= h($minutes->holded_at->format('Y/m/d')) ?>
                                </td>
                                <td class="minute-table-content examined-at">
                                    <?php
                                        if($minutes->is_examined) {
                                            echo $minutes->examined_user_name;
                                            echo "<br>";
                                            echo $minutes->examined_at->format('Y/m/d');
                                        } else {
                                            echo $this->Form->postLink(__('審査'), [
                                                'controller' => 'Minutes',
                                                'action' => 'examine',
                                                $minutes->id
                                            ],
                                            [
                                                'confirm' => "議事録を審査済みとして記録して良いですか？ この操作は取り消せません"
                                            ]);
                                        }
                                    ?>
                                </td>
                                <td class="minute-table-content approved-at">
                                    <?php
                                        if($minutes->is_approved) {
                                            echo $minutes->approved_user_name;
                                            echo "<br>";
                                            echo $minutes->approved_at->format('Y/m/d');
                                        } else {
                                            if ($minutes->is_examined) {
                                                echo $this->Form->postLink(__('承認'), [
                                                    'controller' => 'Minutes',
                                                    'action' => 'approve',
                                                    $minutes->id
                                                ],
                                                [
                                                    'confirm' => "議事録を承認済みとして記録して良いですか? この操作は取り消せません"
                                                ]);
                                            } else {
                                                echo "審査待ち";
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="minute-table-content is-deletable">
                                    <?php
                                        if ($minutes->is_deletable) {
                                            echo $this->Form->postLink(__('削除'), [
                                                'controller' => 'Minutes',
                                                'action' => 'delete', $minutes->id
                                            ],
                                            [
                                                'confirm' => __('削除しますか?')
                                            ]);
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                                <td class="minute-table-content action">
                                    <?= $this->Html->link(__('編集'), ['controller' => 'Minutes', 'action' => 'view', $minutes->id]) ?>
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

            <div class="side-contents right">
                <h4>プロジェクトの詳細</h4>

                <div>
                    <table class="table project project-detail-table">
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
                            <td><?= h($project->started_at->format('Y/m/d')." 〜 ".$project->finished_at->format('Y/m/d')) ?></td>
                        </tr>
                    </table>
                </div>

                <div>
                    <?php if (!empty($projects_users)): ?>
                        <table class="table project project-member-table">
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
                                "classes"=>"project-member",
                                ]) ?>
                        </table>
                    <?php endif; ?>
                </div>

                <center>
                    <?=
                        $this->Html->link('編集', [
                            'action'=>'edit',
                            $project->id
                        ])
                    ?>
                </center>
            </div>

        </div>
    </body>
</html>
