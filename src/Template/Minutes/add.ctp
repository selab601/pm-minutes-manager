<?php
    // ページ固有の CSS, JS の読み込み
    $this->Html->css([
        'lib/jquery-ui.min.css',
        'lib/jquery-ui.theme.min.css',
        'lib/jquery-ui.structure.min.css',
        'lib/jquery.datetimepicker.css',
    ], ['block' => true]);
    $this->Html->script([
        'lib/jquery.datetimepicker.full.js'
    ], ['block' => true]);
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
    <legend>議事録の追加</legend>
    <div class="form-container-fields add-minute">
        <?= $this->Form->input('name', ['label'=>'議事録名 : ']) ?>
        <?= $this->Form->input('holded_place', ['label'=>'開催場所 : ']) ?>
        <?= $this->element('spanDateTimeForm', [
            'form' => $this->form,
            ]) ?>
        <?= $this->element('attendanceForm', [
            'classes' => '',
            'label' => '出席 : ',
            'form' => $this->Form,
            'users_array' => $users_array,
            'default' => '○',
            ])?>
    </div>
</fieldset>
<div class="form-container-footer">
    <?= $this->Form->button("追加") ?>
</div>
<?= $this->Form->end() ?>
