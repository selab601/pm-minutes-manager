<!doctype html>
<html>
  <head>
    <?= $this->html->css('main.css') ?>
    <?= $this->html->css('minute.css') ?>
    <?= $this->html->css('minute-html.css') ?>
    <?= $this->html->script(['jquery.js', 'jquery-ui.min.js']) ?>
    <?= $this->html->script(['elementFromAbsolutePoint.js']) ?>
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
  </head>
  <script>
      $(document).ready(function() {
          $(".table-content.text").each(function() {
              ApplyLineBreaks(this);
          })

          var page_no = 1;
          var i = 0;
          while (true) {
              if (isPageBreakedByItem(page_no)) {
                  addNewPage();
                  var result = retrieveBreakingPageItem(page_no);
                  var item = splitTextInItem(result.breaked_item, page_no);
                  var hided_items = result.hided_items;
                  addItemsToPage(item, result.hided_items, page_no+1);
                  page_no++;
              } else {
                  break;
              }
              // safety break
              if (++i>1000){break;}
          }
      });

      // book 末尾に空のページを加える
      function addNewPage() {
          $('<div class="page"><div class="subpage"><div class="contents"></div></div></div>')
              .appendTo($('.book').last());

          var tableHtml = '<div class="table">'
                        + '  <div class="table-row header">'
                        + '    <div class="table-content no">No</div>'
                        + '    <div class="table-content category">項目</div>'
                        + '    <div class="table-content text">内容</div>'
                        + '    <div class="table-content primary">優先度</div>'
                        + '    <div class="table-content responsibility">担当</div>'
                        + '    <div class="table-content deadline">期限</div>'
                        + '  </div>'
                        + '</div>';
          $(tableHtml).appendTo($('.contents').last());
      }

      // 案件群をページに加える
      function addItemsToPage($item, $items, page_no) {
          // テーブル要素は，案件テーブルの他に議事録情報，承認等欄の2つがある
          // また，要素番号は 0 から始まるので 1 を引く
          var index = page_no + 2 - 1;
          $item.appendTo($('.table:eq('+index+')'));
          $items.appendTo($('.table:eq('+index+')'));
      }

      // はみだしている案件群を取得
      function retrieveBreakingPageItem(page_no) {
          var index = page_no - 1;
          $page_contents = $('.contents:eq('+index+')');
          if ($page_contents.get(0) === undefined) {
              return;
          }

          var position = $page_contents.position();
          // 外側の要素を取得してしまうことがあるので，各々少し内側(-5, 100)から取得
          var bottom = position.top + $page_contents.outerHeight(true) - 5;
          var left = position.left + 100;

          var item_no = document.elementFromAbsolutePoint(left,bottom);
          var $item = $(item_no).parent();
          var $breaked_items = $item.nextAll().clone();
          $item.nextAll().each(function(key, value) {
              $(this).remove();
          });

          return {
              breaked_item : $item,
              hided_items : $breaked_items
          };
      }

      // ページから案件がはみ出しているか
      function isPageBreakedByItem(page_no) {
          var page_index = page_no - 1;
          var table_index = page_no + 2 - 1;
          $subpage = $('.subpage:eq('+page_index+')');
          $table = $('.table:eq('+table_index+')');
          if ($subpage.get(0) === undefined) {
              return;
          }
          var subpage_bottom = $subpage.position().top + $subpage.outerHeight(true);
          var table_bottom = $table.position().top + $table.outerHeight(true);

          return (subpage_bottom < table_bottom);
      }

      // 複数行に渡っている箇所は改行文字を付加する
      function ApplyLineBreaks(text) {
          var MAX_BYTE = 50;
          var new_lines = [];
          var lines = $(text).text().split('\n');
          for(var i=0; i<lines.length; i++) {
              if (countLength(lines[i]) > MAX_BYTE) {
                  var new_line = "";
                  var bytes = 0;
                  for (var j=0; j<lines[i].length; j++) {
                      bytes += countByte(lines[i].charCodeAt(j));
                      if (bytes > MAX_BYTE) {
                          new_lines.push(new_line);
                          new_line = "";
                          bytes = countByte(lines[i].charCodeAt(j));
                      }
                      new_line += lines[i][j];
                  }

                  if (!(new_line === "")) {
                      new_lines.push(new_line);
                  }
              } else {
                  new_lines.push(lines[i]);
              }
          }
          $(text).html(new_lines.join('<br>'))
      }

      function countByte(c) {
          // Shift_JIS: 0x0 ～ 0x80, 0xa0 , 0xa1 ～ 0xdf , 0xfd ～ 0xff
          // Unicode : 0x0 ～ 0x80, 0xf8f0, 0xff61 ～ 0xff9f, 0xf8f1 ～ 0xf8f3
          if ( (c >= 0x0 && c < 0x81) || (c == 0xf8f0) || (c >= 0xff61 && c < 0xffa0) || (c >= 0xf8f1 && c < 0xf8f4)) {
              return 1;
          } else {
              return 2;
          }
      }

      function countLength(str) {
          var r = 0;
          for (var i = 0; i < str.length; i++) {
              var c = str.charCodeAt(i);
              r += countByte(c);
          }
          return r;
      }

      // 案件の内容を，改ページしている場所で分割する
      function splitTextInItem($item, page_no) {
          var page_index = page_no - 1;
          var table_index = page_no + 2 - 1;
          $subpage = $('.subpage:eq('+page_index+')');
          $table = $('.table:eq('+table_index+')');
          if ($subpage.get(0) === undefined) {
              return;
          }
          var subpage_bottom = $subpage.position().top + $subpage.outerHeight(true);
          var table_bottom = $table.position().top + $table.outerHeight(true);
          var breaked_height = table_bottom - subpage_bottom;

          var line_height = parseInt($item.css('line-height'));
          var item_height = $item.outerHeight(true);
          var all_line_numbers = item_height/line_height;
          var breaked_line_numbers = breaked_height/line_height;

          var lines = $item.children(".text").html().split('<br>');

          var index = all_line_numbers - breaked_line_numbers - 1;
          var text = lines.slice(0, index-1);
          var hided_text = lines.slice(index-1, lines.length);

          var $breaked_item = $item.clone();
          $item.children(".text").html(text.join('<br>'));
          $breaked_item.children(".text").html(hided_text.join('<br>'));

          return $breaked_item;
      }
  </script>
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
                        審査
                      </div>
                      <div class="table-content column-td">
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
                        作成
                      </div>
                      <div class="table-content column-td">
                        <?= $minute->created_at->format('Y/m/d') ?>
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
                        <?= h($item->item_category_name) ?>
                      </div>
                      <div class="table-content text"><?= nl2br($item->contents) ?></div>
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

    </div>
  </body>
</html>
