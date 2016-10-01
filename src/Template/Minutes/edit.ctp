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
            $('#datetimepicker').datetimepicker();
        });
    </script>
    <body>
        <?= $this->element('header') ?>

        <?php
            $this->Form->templates([
                'inputContainer' => '<div class="form-container-field">{{content}}</div>',
                'input' => '<input class="form-container-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
                'dateWidget' => '<div class="form-container-field-input"><div class="date-form">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div></div>',
            ]);
        ?>

        <div class="form-container-wrapper">
            <?php
                echo $this->Form->create($minute, [
                    'class'=>'form-container add-minute',
                ]);
            ?>
            <fieldset>
                <legend>議事録の編集</legend>
                <div class="form-container-fields add-minute">
                    <?php
                        echo $this->Form->input('name', ['label' => '議事録名 : ']);
                        echo $this->Form->input('holded_place', ['label' => '開催場所 : ']);
                        echo $this->Form->input('holded_at', [
                            'empty' => true,
                            'value'=>$minute->holded_at->format('Y/m/d H:i'),
                            'label'=>'開催時刻 : ',
                            'type'=>'text',
                            'id'=>'datetimepicker',
                        ]);
                    ?>
                    <div class="checkbox-form form-container-field add-minute">
                        <label>参加者 : </label>
                        <div class="checkbox-form-input-wrapper">
                            <div class="checkbox-form-input">
                                <?php
                                    echo $this->Form->input('projects_users._ids', [
                                        'options' => $users_array,
                                        'multiple' => 'checkbox',
                                        'checked' => true,
                                        'default' => $checked_users_array,
                                        'label' => false,
                                        'templates' => [
                                            'inputContainer' => '{{content}}',
                                        ],
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-container-footer">
                <?= $this->Form->button("追加") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
