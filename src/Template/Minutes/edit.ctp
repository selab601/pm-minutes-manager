<?php
$this->Html->css('jquery-ui.min.css', ['block' => true]);
$this->Html->css('jquery-ui.theme.min.css', ['block' => true]);
$this->Html->css('jquery-ui.structure.min.css', ['block' => true]);
$this->Html->css('jquery.datetimepicker.css', ['block' => true]);
$this->Html->script(['jquery.datetimepicker.full.js'], ['block' => true]);
?>
<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: 'yy/mm/dd'});
        jQuery('#datetimepicker1').datetimepicker({
            datepicker:false,
            format:'H:i'
        });
        jQuery('#datetimepicker2').datetimepicker({
            datepicker:false,
            format:'H:i'
        });
    });
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
