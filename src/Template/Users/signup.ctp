<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <?php
        $this->Form->templates([
            'inputContainer' => '<div class="form-container-field">{{content}}</div>',
            'input' => '<input class="form-container-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
        ])
    ?>

    <div class="form-container-wrapper">
        <?php
            echo $this->Form->create('User', [
                'class'=>'form-container add-user',
            ]);
        ?>
        <fieldset>
            <legend>ユーザの追加</legend>
            <div class="form-container-fields add-user">
                <?= $this->Form->input('id_string', ['label' => 'ID : ',]) ?>
                <div class="form-container-field">
                    <label>名前 : </label>
                    <div class="form-container-field-input">
                        <div class="name-form">
                            <?= $this->Form->input('last_name', [
                                'label' => false,
                                'templates' => ['inputContainer' => '{{content}}'],
                                'placeholder' => '性',
                                'id' => 'name-form-last-name',
                                ])?>
                            <?= $this->Form->input('first_name', [
                                'label' => false,
                                'placeholder' => '名',
                                'templates' => ['inputContainer' => '{{content}}'],
                                'id' => 'name-form-first-name',
                                ]) ?>
                        </div>
                    </div>
                </div>
            <?= $this->Form->input('password', ['label' => 'パスワード : ',]) ?>
            <?= $this->Form->input('mail', ['label' => 'メールアドレス : ',]) ?>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("追加") ?>
        </div>
        <?= $this->Form->end() ?>
    </div>

</body>
</html>
