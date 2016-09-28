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

        <div class="contents">

            <div class="side-contents">

                <h4>議事録詳細</h4>

                <table class="table">
                    <tr>
                        <th>プロジェクト名</th>
                        <td>
                            <?= $minute->has('project') ? $this->Html->link($minute->project->name, ['controller' => 'Projects', 'action' => 'view', $minute->project->id]) : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>議事録名</th>
                        <td><b><?= h($minute->name) ?></b></td>
                    </tr>
                    <tr>
                        <th>日時</th>
                        <td><?= h($minute->holded_at) ?></td>
                    </tr>
                    <tr>
                        <th>場所</th>
                        <td><?= h($minute->holded_place) ?></td>
                    </tr>
                    <tr>
                        <th>作成日</th>
                        <td><?= h($minute->created_at) ?></td>
                    </tr>
                    <tr>
                        <th>更新日</th>
                        <td><?= h($minute->updated_at) ?></td>
                    </tr>
                </table>

                <!-- 出席情報 -->
                <table class="table">
                    <tr><th colspan="6">出席状況( ◯ : 参加, △ : 遅刻, ✕ : 不参加 )</th></tr>
                    <?= $this->element('userTable', [
                        "users"=>$users,
                        "add_participation"=>true,
                        "col_num"=>2,
                        ]) ?>
                </table>

            </div>

            <div class="main-contents">

                <h4>議事録</h4>

                <!-- 案件一覧 -->
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
                                            <?= $this->Html->link(__('編集'), ['controller' => 'Items', 'action' => 'edit', $item->id]) ?>
                                            <?= $this->Form->postLink(__('削除'), ['controller' => 'Items', 'action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
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
        </div>
    </body>
</html>
