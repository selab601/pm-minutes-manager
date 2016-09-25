<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered col-md-6">
                        <tr>
                            <td class="col-md-6" colspan="4">
                                <small>
                                    <?= $minute->has('project') ? $this->Html->link($minute->project->name, ['controller' => 'Projects', 'action' => 'view', $minute->project->id]) : '' ?>
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6" colspan="4"><b><?= h($minute->name) ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-md-1"><center><b>日時</b></center></td>
                            <td class="col-md-2"><?= h($minute->holded_at) ?></td>
                            <td class="col-md-1"><center><b>場所</b></center></td>
                            <td class="col-md-2"><?= h($minute->holded_place) ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1"><center><b>作成日</b></center></td>
                            <td class="col-md-2"><?= h($minute->created_at) ?></td>
                            <td class="col-md-1"><center><b>更新日</b></center></td>
                            <td class="col-md-2"><?= h($minute->updated_at) ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <caption><h4><b>出席状況 ( ◯ : 参加, △ : 遅刻, ✕ : 不参加 )</b></h4></caption>
                    <table class="table table-bordered col-sm-12">
                        <?php
                            $i = 0;
                            foreach ($usernames_participations as $username => $is_participated) {
                                if ($i/3 == 0) { echo "<tr>"; }

                                $participation = $is_participated ? "◯" : "✕";
                                echo "<td class='col-sm-1'><center>".$participation."</center></td>";
                                echo "<td class='col-sm-3'>".$username."</td>";

                                if ($i/3 == 2) { echo "</tr>"; }
                                $i++;
                            }

                            for ($j = $i ; (int)($j/3) == 0; $j++) {
                                echo "<td class='col-sm-1'><center> - </center></td>";
                                echo "<td class='col-sm-3'> --------------------- </td>";

                                if ($j/3 == 2) { echo "</tr>"; }
                            }
                        ?>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered col-md-12" cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-1">項目</th>
                            <th class="col-md-6">内容</th>
                            <th class="col-md-1">優先度</th>
                            <th class="col-md-1">担当</th>
                            <th class="col-md-1">期限</th>
                            <th class="col-md-1">Actions</th>
                        </tr>
                        <?php if (!empty($minute->items)): ?>
                            <?php foreach ($minute->items as $item): ?>
                                <tr>
                                    <td><center><?= h($item->order_in_minute) ?></center></td>
                                    <td><center><?= h($item->item_category_name) ?></center></td>
                                    <td><?= h($item->contents) ?></td>
                                    <td><center>
                                        <?php
                                            switch($item->primary_no) {
                                                case 0: echo "低"; break;
                                                case 1: echo "中"; break;
                                                case 2: echo "高"; break;
                                                default: echo "";
                                            }
                                        ?>
                                    </center></td>
                                    <td>
                                        <?php
                                            echo "<ul>";
                                            foreach($item->user_names as $user_name) {
                                                echo "<li>".$user_name."</li>";
                                            }
                                            echo "</ul>";
                                        ?>
                                    </td>
                                    <td><?= h($item->overed_at) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $item->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $item->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                        <?php endif; ?>
                        <center>
                            <?=
                                $this->Html->link('新規作成', [
                                    'controller'=>'Items',
                                    'action'=>'add',
                                    $minute->id
                                ])
                            ?>
                        </center>
                </div>
            </div>
        </div>
    </body>
</html>
