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

            <div class="related">
                <h4>議事内容</h4>
                <?php if (!empty($minute->items)): ?>
                    <table class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <th scope="col"><?= __('Id') ?></th>
                            <th scope="col"><?= __('Minute Id') ?></th>
                            <th scope="col"><?= __('Primary No') ?></th>
                            <th scope="col"><?= __('Item Category Id') ?></th>
                            <th scope="col"><?= __('Order In Minute') ?></th>
                            <th scope="col"><?= __('Contents') ?></th>
                            <th scope="col"><?= __('Revision') ?></th>
                            <th scope="col"><?= __('Overed At') ?></th>
                            <th scope="col"><?= __('Created At') ?></th>
                            <th scope="col"><?= __('Updated At') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($minute->items as $items): ?>
                            <tr>
                                <td><?= h($items->id) ?></td>
                                <td><?= h($items->minute_id) ?></td>
                                <td><?= h($items->primary_no) ?></td>
                                <td><?= h($items->item_category_id) ?></td>
                                <td><?= h($items->order_in_minute) ?></td>
                                <td><?= h($items->contents) ?></td>
                                <td><?= h($items->revision) ?></td>
                                <td><?= h($items->overed_at) ?></td>
                                <td><?= h($items->created_at) ?></td>
                                <td><?= h($items->updated_at) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
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
    </body>
</html>
