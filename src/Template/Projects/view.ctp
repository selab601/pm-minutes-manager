<?= $this->assign('title', '議事録一覧') ?>
<div class="contents">

    <?= $this->element('sidebar') ?>

    <div class="main-contents project-view right">

        <h4>議事録一覧</h4>
        <center>
            プロジェクト内の議事録一覧が表示されます．会議毎に必ず作成するようにしましょう．<br>
            作成した議事録は「審査」->「承認」の順にレビューします．<br>
            <b>開発員が作成した議事録</b>を<b>PMがレビュー</b>し，OKであれば「審査」済みにします．<br>
            <b>「審査」済みの議事録</b>を<b>課長がレビュー</b>し，OKであれば「承認」済みにします．<br>
            「審査」「承認」は一度行うと取り消せません．また，「審査」が通った議事録は削除できなくなるので注意しましよう．<br>
        </center>

        <?php if (!empty($project->minutes)): ?>
            <table class="table minute projects-view">
                <tr>
                    <th class="minute-table-content minute-name" scope="col">議事録名</th>
                    <th class="minute-table-content holded-at">開催日</th>
                    <th class="minute-table-content examined-at" scope="col">審査</th>
                    <th class="minute-table-content approved-at" scope="col">承認</th>
                    <th class="minute-table-content is-deletable" scope="col">削除</th>
                </tr>
                <?php foreach ($project->minutes as $minutes): ?>
                    <tr>
                        <td class="minute-table-content minute-name">
                            <?= $this->Html->link($minutes->name, ['controller' => 'Minutes', 'action' => 'view', $minutes->id]) ?>
                            <span class="for_examine_or_approve">
                                (<?= $this->Html->link('審査/承認用ビュー', ['controller' => 'Minutes', 'action' => 'create-html', $minutes->id]) ?>)
                            </span>
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
