<!doctype html>
<html>
  <head>
    <?= $this->html->css('main.css') ?>
    <?= $this->html->css('minute.css') ?>
    <?= $this->html->css('minute-html.css') ?>
  </head>
  <body>
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
                      <div class="table-content half-td"><?= h($minute->holded_at) ?></div>
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
                      </div>
                    </div>
                  </div>
                  <div class="table-row">
                    <div class="table-content-wrapper column">
                      <div class="table-content column-th header">
                        審査
                      </div>
                      <div class="table-content column-td">
                      </div>
                    </div>
                  </div>
                  <div class="table-row">
                    <div class="table-content-wrapper column">
                      <div class="table-content column-th header">
                        作成
                      </div>
                      <div class="table-content column-td">
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
                </div>

                <?php if (!empty($items)): ?>
                  <?php foreach ($items as $item): ?>
                    <div class="table-row ui-state-default">
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
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </body>
</html>
