<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('minute.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js', 'common.js']) ?>
    </head>
    <script>
        $(function () {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var order = [];
                    var i=0;
                    $(".table-content.no").each(function (item, index) {
                        if (i==0) { i++; return; }
                        order.push($(this).text().replace(/\s+/g, ""));
                        $(this).text(i);
                        i++;
                    });
                    var json = JSON.stringify(order);
                    console.log(json);

                    sendPost(
                        "/minutes/ajaxUpdateItemOrder",
                        {
                            order: json,
                            minute_id: <?= $minute->id ?>
                        },
                        null)
                        .done(function(result) {
                            console.log(result);
                        });
                }
            });
            $("#sortable").disableSelection();
        });
    </script>
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
                            foreach ($users as $user) {
                                if ($i/3 == 0) { echo "<tr>"; }

                                echo "<td class='col-sm-1'><center>".$user['participation']."</center></td>";
                                echo "<td class='col-sm-3'>".$user['name']."</td>";

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
                    <div class="table-row header">
                        <div class="table-content no">No</div>
                        <div class="table-content category">項目</div>
                        <div class="table-content text">内容</div>
                        <div class="table-content primary">優先度</div>
                        <div class="table-content responsibility">担当</div>
                        <div class="table-content deadline">期限</div>
                        <div class="table-content actions"></div>
                    </div>

                    <?php if (!empty($items)): ?>
                        <div id="sortable">
                            <?php foreach ($items as $item): ?>
                                <div class="table-row ui-state-default">
                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                    <div class="table-content no">
                                        <?= h($item->order_in_minute) ?>
                                    </div>
                                    <div class="table-content category">
                                        <?= h($item->item_category_name) ?>
                                    </div>
                                    <div class="table-content text">
                                        <?= h($item->contents) ?>
                                    </div>
                                    <div class="table-content primary">
                                        <?= h($item->primary_char) ?>
                                    </div>
                                    <div class="table-content responsibility">
                                        <?php
                                            echo "<ul>";
                                            foreach($item->user_names as $user_name) {
                                                echo "<li>".$user_name."</li>";
                                            }
                                            echo "</ul>";
                                        ?>
                                    </div>
                                    <div class="table-content deadline">
                                        <?= h($item->overed_at) ?>
                                    </div>
                                    <div class="table-content actions">
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $item->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                </div>
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
