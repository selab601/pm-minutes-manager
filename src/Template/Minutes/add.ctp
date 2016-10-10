<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery.datetimepicker.css') ?>
        <?= $this->html->css('jquery-ui.min.css') ?>
        <?= $this->html->css('jquery-ui.theme.min.css') ?>
        <?= $this->html->css('jquery-ui.structure.min.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery-ui.min.js', 'jquery.datetimepicker.full.js', 'bootstrap.min.js']) ?>
    </head>
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
    <body>
        <?= $this->element('header') ?>

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
    </body>
</html>
