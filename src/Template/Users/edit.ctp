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
            ])
        ?>

        <div class="form-container-wrapper">
            <?= $this->Form->create($user, ['class'=>'form-container', 'id'=>'add-user-container']) ?>
                <fieldset class="form-container-fields">
                    <legend>ユーザの編集</legend>
                    <?= $this->Form->input('id_string', ['label'=>'ID : ']) ?>
                    <div class="form-container-fields-field">
                        <label>名前 : </label>
                        <div class="form-container-fields-field-input">
                            <div class="name-form">
                                <?= $this->Form->input('last_name', [
                                    'label' => false,
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'placeholder' => '性',
                                    ])?>
                                <?= $this->Form->input('first_name', [
                                    'label' => false,
                                    'placeholder' => '名',
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    ]) ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->input('password', [
                        'value' => "",
                        'required' => false,
                        'label' => 'パスワード : ',
                        ]) ?>
                    <?= $this->Form->input('mail', ['label'=>'メールアドレス : ']) ?>
                </fieldset>
                <div class="form-container-footer">
                    <?= $this->Form->button("決定") ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
