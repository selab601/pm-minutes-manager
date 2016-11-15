<div class="contents users-projects-view">

    <div class="main-contents  users-projects-view">
        <center>
            <h4>プロジェクト一覧</h4>
            あなたが参加中のプロジェクト一覧が表示されます．<br>
            PMは「新規作成」から，メンバーとして開発員，課長を加えたプロジェクトを新たに作成しましょう．
        </center>
        <?php if (!empty($user->projects)): ?>
            <table class="table project-table project">
                <tr>
                    <th class="project-table-content project-name" scope="col">プロジェクト名</th>
                    <th class="project-table-content started-at" scope="col">プロジェクト期間</th>
                </tr>
                <?php foreach ($user->projects as $projects): ?>
                    <tr>
                        <td class="project-table-content project-name">
                            <?= $this->Html->link(__($projects->name), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                        </td>
                        <td class="project-table-content started-at">
                            <?= h($projects->started_at->format('Y/m/d')) ?> 〜 <?= h($projects->finished_at->format('Y/m/d')) ?>
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
