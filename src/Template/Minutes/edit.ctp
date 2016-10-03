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

        <?php
            $now = new \DateTime();
            $date = $minute->holded_at == NULL ? "" : $minute->holded_at->format('Y/m/d');
            $ended_at = $minute->ended_at == NULL ? "" : $minute->ended_at->format('H:i');
            $holded_at = $minute->holded_at == NULL ? "" : $minute->holded_at->format('H:i');
        ?>

        <?= $this->element('formContainerTemplate') ?>
        <?= $this->Form->create($minute, ['class'=>'form-container add-minute']); ?>
        <fieldset>
            <legend>議事録の編集</legend>
            <p>
                現在，システムの使用上参加者のステータスとして「遅刻」が記録できません．<br>
                近々修正予定です．修正次第TOPページでご連絡します．<br>
            </p>
            <?= $this->Form->input('name', ['label'=>'議事録名 : ']) ?>
            <?= $this->Form->input('holded_place', ['label'=>'開催場所 : ']) ?>
            <?= $this->element('spanDateTimeForm', [
                'form' => $this->form,
                'date' => $date,
                'holded_at' => $holded_at,
                'ended_at' => $ended_at,
                ]) ?>
            <?= $this->element('checkboxForm', [
                'name' => 'projects_users._ids',
                'label' => '参加者 : ',
                'classes' => 'add-minute',
                'form' => $this->Form,
                'options' => $users_array,
                'default' => $checked_users_array,
                ]) ?>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("追加") ?>
        </div>
        <?= $this->Form->end() ?>
    </body>
</html>
