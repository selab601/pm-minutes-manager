<?= $this->assign('title', '議事録編集') ?>
<?php
    // ページ固有の CSS, JS の読み込み
    $this->Html->css([
        'lib/jquery-ui.min.css',
        'lib/jquery-ui.theme.min.css',
        'lib/jquery-ui.structure.min.css',
        'lib/jquery.datetimepicker.css',
    ], ['block' => true]);
    $this->Html->script([
        'lib/jquery.datetimepicker.full.js',
        'addDateTimePicker.js'
    ], ['block' => true]);
?>
<script>
    $("#datepicker").datepicker({dateFormat: 'yy/mm/dd'});
    addDateTimePicker("#datetimepicker1");
    addDateTimePicker("#datetimepicker2");
</script>

<?= $this->element('formContainerTemplate') ?>
<?= $this->Form->create($minute, ['class'=>'form-container add-minute']); ?>
<fieldset>
    <legend>議事録の編集</legend>
    <p>
        現在，システムの使用上参加者のステータスとして「遅刻」が記録できません．<br>
        近々修正予定です．修正次第TOPページで通知します．<br>
    </p>
    <?= $this->Form->input('name', ['label'=>'議事録名 : ']) ?>
    <?= $this->Form->input('holded_place', ['label'=>'開催場所 : ']) ?>
    <?= $this->element('spanDateTimeForm', [
        'form' => $this->form,
        'date' => $date,
        'holded_at' => $holded_at,
        'ended_at' => $ended_at,
        ]) ?>
    <?= $this->element('attendanceForm', [
        'classes' => '',
        'label' => '出席 : ',
        'form' => $this->Form,
        'users_array' => $users_array,
        'defaults' => $checked_users_array,
        'default' => '×',
        ])?>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button("追加") ?>
</div>
<?= $this->Form->end() ?>
