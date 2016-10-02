<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery.datetimepicker.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery.datetimepicker.full.js', 'bootstrap.min.js']) ?>
    </head>
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
            $('#datetimepicker2').datetimepicker();
        });
    </script>
    <body>
        <?= $this->element('header') ?>

        <?php
            $now = new \DateTime();
            $ended_at = $minute->ended_at == NULL ? "" : $minute->ended_at->format('Y/m/d H:i');
            $holded_at = $minute->holded_at == NULL ? "" : $minute->holded_at->format('Y/m/d H:i');
        ?>

        <?= $this->element('formContainerTemplate') ?>
        <div class="form-container-wrapper">
            <?= $this->Form->create($minute, ['class'=>'form-container add-minute']); ?>
            <fieldset>
                <legend>議事録の編集</legend>
                <?= $this->Form->input('name', ['label'=>'議事録名 : ']) ?>
                <?= $this->Form->input('holded_place', ['label'=>'開催場所 : ']) ?>
                <?= $this->Form->input('holded_at', [
                    'type' => 'datetime',
                    'value'=>$holded_at,
                    'label' => '開催時刻 : ',
                    'type'=>'text',
                    'id'=>'datetimepicker1',
                    ]) ?>
                <?= $this->Form->input('ended_at', [
                    'type' => 'datetime',
                    'value'=>$ended_at,
                    'label' => '終了時刻 : ',
                    'type'=>'text',
                    'id'=>'datetimepicker2',
                    ]) ?>
                <?= $this->element('checkboxForm', [
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
        </div>
    </body>
</html>
