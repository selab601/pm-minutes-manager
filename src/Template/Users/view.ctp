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
                <h4>プロフィール</h4>
                <table class="table">
                    <tr>
                        <th scope="row">ID</th>
                        <td><?= h($user->id_string) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">名前</th>
                        <td><?= h($user->first_name)." ".h($user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td><?= h($user->mail) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">登録日</th>
                        <td><?= h($user->created_at) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">管理者権限</th>
                        <td><?= $user->is_authorized ? 'あり' : 'なし'; ?></td>
                    </tr>
                </table>
                <center>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id]) ?>
                </center>
            </div>

            <div class="main-contents">
                <h4>参加中のプロジェクト一覧</h4>
                <?php if (!empty($user->projects)): ?>
                    <table class="table">
                        <tr>
                            <th scope="col">プロジェクト名</th>
                            <th scope="col">プロジェクト期間</th>
                            <th scope="col" class="actions"></th>
                            <th scope="col" class="actions"></th>
                        </tr>
                        <?php foreach ($user->projects as $projects): ?>
                            <tr>
                                <td><?= h($projects->name) ?></td>
                                <td>
                                    <?= h($projects->started_at) ?> 〜 <?= h($projects->finished_at) ?>
                                </td>
                                <td>
                                    <?= $this->Html->link(__('詳細'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                                </td>
                                <td>
                                    <?= $this->Html->link(__('編集'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                <center>
                    <?=
                        $this->Html->link('新規作成', [
                            'controller'=>'Projects',
                            'action'=>'add'
                        ])
                    ?>
                </center>
            </div>

        </div>
    </body>
</html>
