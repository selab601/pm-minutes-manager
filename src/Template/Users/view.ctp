<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>


        <div class="contents users-view">

            <div class="main-contents users-view">
                <h4>プロフィール</h4>
                <table class="table user-detail-table user">
                    <tr>
                        <th scope="row">ID</th>
                        <td><?= h($user->id_string) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">名前</th>
                        <td><?= h($user->last_name)." ".h($user->first_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td><?= h($user->mail) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">登録日</th>
                        <td><?= h($user->created_at->format('Y/m/d')) ?></td>
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
        </div>
    </body>
</html>
