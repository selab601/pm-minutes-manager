<?= $this->assign('title', h($minute->name)) ?>
<?= $this->Html->script(['Minutes/create_html.js'], ['block' => true]) ?>

<div class="book">
    <div class="page">
        <div class="subpage">

            <div class="contents">
                <div class="contents-header">
                    <div class="contents-header-info">

                        <div class="table">
                            <div class="table-row">
                                <div class="table-content project-name">
                                    <?= $minute->project->name ?>
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-content minute-name">
                                    <?= h($minute->name) ?>
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-content-wrapper half">
                                    <div class="table-content half-th header">日時</div>
                                    <div class="table-content half-td">
                                        <?= h($minute->holded_at->format('Y/m/d H:i')) ?>
                                        〜
                                        <?= h($minute->ended_at->format('H:i')) ?>
                                    </div>
                                </div>
                                <div class="table-content-wrapper half">
                                    <div class="table-content half-th header">場所</div>
                                    <div class="table-content half-td"><?= h($minute->holded_place) ?></div>
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-content header">
                                    出席状況 ( 出席 : ◯, 遅刻 : △, 欠席 : ✕ )
                                </div>
                            </div>
                            <?php
                                $i = 0;
                                foreach ($user_array as $user) {
                                    if ($i%4 == 0) {
                                        echo "<div class='table-row'>";
                                    }

                                    echo "<div class='table-content-wrapper quoter'>";
                                    echo "<div class='table-content quoter-th'>".$user['participation']."</div>";
                                    echo "<div class='table-content quoter-td'>".$user['name']."</div>";
                                    echo "</div>";

                                    if ($i%4 == 3) {
                                        echo "</div>";
                                    }
                                    $i++;
                                }

                                for ($j = $i; $j%4 != 0; $j++) {
                                    echo "<div class='table-content-wrapper quoter'>";
                                    echo "<div class='table-content quoter-th'></div>";
                                    echo "<div class='table-content quoter-td'></div>";
                                    echo "</div>";
                                    if ($j%4 == 3) {
                                        echo "</div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class="contents-header-column">
                        <div class="table right">
                            <div class="table-row">
                                <div class="table-content-wrapper column">
                                    <div class="table-content column-th header" id="column-first">
                                        承認
                                    </div>
                                    <div class="table-content column-td" id="column-first">
                                        <?php
                                            if ($minute->is_approved) {
                                                echo $minute->approved_at->format('Y/m/d');
                                                echo "<br>";
                                                echo $minute->approved_user_name;
                                            } else {
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-content-wrapper column">
                                    <div class="table-content column-th header">
                                        審査
                                    </div>
                                    <div class="table-content column-td">
                                        <?php
                                            if ($minute->is_examined) {
                                                echo $minute->examined_at->format('Y/m/d');
                                                echo "<br>";
                                                echo $minute->examined_user_name;
                                            } else {
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-content-wrapper column">
                                    <div class="table-content column-th header">
                                        作成
                                    </div>
                                    <div class="table-content column-td">
                                        <?= $minute->created_at->format('Y/m/d') ?>
                                        <?= "<br>" ?>
                                        <?= $minute->created_user_name ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="contents-minute">
                    <div class="table">

                        <!-- 案件一覧 -->
                        <div class="table-row header">
                            <div class="table-content no">No</div>
                            <div class="table-content category">項目</div>
                            <div class="table-content text">内容</div>
                            <div class="table-content primary">優先度</div>
                            <div class="table-content responsibility">担当</div>
                            <div class="table-content deadline">期限</div>
                            <div class="table-content follow">フォロー</div>
                        </div>

                        <?php if (!empty($items)): ?>
                            <?php foreach ($items as $item): ?>
                                <div class="table-row item">
                                    <div class="table-content no">
                                        <?= h($item->order_in_minute) ?>
                                    </div>
                                    <div class="table-content category">
                                        <?php
                                            if ($item->item_meta_category_name == "タスク") {
                                                echo "【タスク】<br>";
                                            }
                                        ?>
                                        <?= h($item->item_category_name) ?>
                                    </div>
                                    <div class="table-content text"><?= nl2br($item->contents) ?></div>
                                    <div class="table-content primary">
                                        <?= h($item->primary_char) ?>
                                    </div>
                                    <div class="table-content responsibility">
                                        <?php
                                            if (empty($item->user_names)) {
                                                echo "-";
                                            } else {
                                                foreach($item->user_names as $user_name) {
                                                    echo $user_name;
                                                    echo "<br>";
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="table-content deadline">
                                        <?php
                                            if ($item->overed_at != NULL) {
                                                echo $item->overed_at->format('Y/m/d');
                                            } else {
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                    <div class="table-content follow">
                                        <?php
                                            if ($item->is_followed != NULL) {
                                                echo $item->followed_at->format('Y/m/d');
                                                echo "<br>";
                                                echo $item->followed_user_name;
                                            } else {
                                                echo "-";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="pdf-image-button">
        <?= $this->Html->image('pdf.png', ["data-toggle"=>"modal", "data-target"=>"#squarespaceModal", "style"=>"cursor:pointer;"]) ?>
    </div>

    <!-- line modal -->
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">
                        PDF出力について
                    </h3>
                </div>
                <div class="modal-body">
                    印刷時の設定により，PDF として保存することができます．
                    ご利用のブラウザに応じて設定し，出力してください．

                    <div class="print-method-wrapper">
                        <div class="print-method-row">
                            <div class="print-method">
                                <h3>Firefox</h3>
                                <p>左下から「PDFとして保存」を選択</p>
                                <?= $this->Html->image('print-firefox.png', ["style"=>"width:200px;"]) ?>
                            </div>
                            <div class="print-method">
                                <h3>Google Chrome</h3>
                                <p>送信先 -> ローカルの送信先 から「PDFに保存」を選択</p>
                                <?= $this->Html->image('print-chrome.png', ["style"=>"width:250px;"]) ?>
                            </div>
                        </div>
                        <div class="print-method-row">
                            <div class="print-method">
                                <h3>Safari</h3>
                                <p>左下から「PDFとして保存」を選択</p>
                                <?= $this->Html->image('print-safari.png', ["style"=>"width:250px;"]) ?>
                            </div>
                            <div class="print-method">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">
                                閉じる
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button" onClick="window.print()">
                                印刷
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
