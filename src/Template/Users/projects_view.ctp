<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="contents users-projects-view">

            <div class="main-contents  users-projects-view">
                <center><h4>参加中のプロジェクト一覧</h4></center>
                <?php if (!empty($user->projects)): ?>
                    <table class="table project-table project">
                        <tr>
                            <th class="project-table-content project-name" scope="col">プロジェクト名</th>
                            <th class="project-table-content started-at" scope="col">プロジェクト期間</th>
                            <th class="project-table-content view-minutes" scope="col" class="actions"></th>
                        </tr>
                        <?php foreach ($user->projects as $projects): ?>
                            <tr>
                                <td class="project-table-content project-name">
                                    <?= h($projects->name) ?>
                                </td>
                                <td class="project-table-content started-at">
                                    <?= h($projects->started_at->format('Y/m/d')) ?> 〜 <?= h($projects->finished_at->format('Y/m/d')) ?>
                                </td>
                                <td class="project-table-content view-minutes">
                                    <?= $this->Html->link(__('議事録一覧'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
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
