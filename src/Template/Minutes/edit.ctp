<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>


        <?php
            $this->Form->templates([
                'inputContainer' => '<div class="form-container-fields-field">{{content}}</div>',
                'input' => '<input class="form-container-fields-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
            ]);
        ?>


        <div class="form-container-wrapper">
            <?= $this->Form->create('Minute', ['class'=>'form-container', 'id'=>'add-minute-container']) ?>
            <fieldset class="form-container-fields">
                <legend>議事録の編集</legend>
                <?php
                    echo $this->Form->input('name', ['label' => '議事録名']);
                    echo $this->Form->input('holded_place', ['label' => '開催場所']);
                    echo $this->Form->input('holded_at', ['empty' => true, 'label'=>'開催時刻']);
                ?>
            </fieldset>
            <div class="form-container-footer">
                <?= $this->Form->button("追加") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
