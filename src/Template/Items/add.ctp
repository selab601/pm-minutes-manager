<?php
$this->Html->css('jquery-ui.min.css', ['block' => true]);
$this->Html->css('jquery-ui.theme.min.css', ['block' => true]);
$this->Html->css('jquery-ui.structure.min.css', ['block' => true]);
?>
<script>
    $(document).ready(function () {
        $( "#datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});

        var meta_categories = <?= json_encode($item_meta_category_array) ?>;
        var categories = <?= json_encode($item_categories_array) ?>;
        $("select#meta-category").change(function() {
            $("select#category").empty();
            $.each(categories[$(this).val()], function(key, value) {
                $("select#category").append(
                    $("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
        });

        // 動的に入力文字数をカウント
        document.getElementById('contents').onkeyup = function() {
            var length = document.getElementById('contents').value.length;
            var length_str = "";
            if (length > 200) {
                length_str = "<span style='color:red'>" + length + "</span>";
            } else {
                length_str = "<span>" + length + "</span>";
            }
            document.getElementById('contents-chars').innerHTML = length_str + "/200";
        }
        // ページ読み込み時に入力文字数を更新
        $('#contents').keyup();
    });
</script>

<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($item, ['class'=>'form-container add-item']) ?>
<fieldset>
    <legend>案件を追加する</legend>
    <p>
        案件項目を「タスク」に設定した場合には，「期限」を必ず設定するようにしてください．<br>
        「期限」を設定しない場合，現在のシステムの使用上「フォロー」を行うことができません．<br>
        また，「フォロー」済みの案件の期限，担当者は変更できません．
    </p>
    <div class="form-container-fields add-item">
        <?= $this->Form->input('primary_char', [
            'options' => [
                '-' => "-",
                "高" => "高",
                "中" => "中",
                "低" => "低"
            ],
            'default' => "中",
            'label' => '優先度 : ',
            'value' => "-",
            ]) ?>
        <?= $this->Form->input('item_meta_category_id', [
            'options' => $item_meta_category_array,
            'label' => '案件項目 : ',
            'id' => 'meta-category'
            ]) ?>
        <?= $this->Form->input('item_category_id', [
            'options' => $item_categories_array[1],
            'label' => '案件種別 : ',
            'id' => 'category'
            ]) ?>
        <?= $this->Form->input('contents', [
            'label'=>'議事内容 : ',
            'type'=>'textarea',
            ]) ?>
        <div id="contents-chars"></div>
        <?= $this->Form->input('overed_at', [
            'empty' => true,
            'label'=>'期限 : ',
            'type'=>'text',
            'id'=>'datepicker',
            ]) ?>
        <?= $this->element('checkboxForm', [
            'name' => 'projects_users._ids',
            'label' => '担当者 : ',
            'classes' => 'add-item',
            'form' => $this->Form,
            'options' => $users_array,
            'default' => '',
            ]) ?>
    </div>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button("決定") ?>
</div>
