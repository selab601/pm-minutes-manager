<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <?= $this->element('formContainerTemplate') ?>
    <div class="form-container-wrapper">
        <?= $this->Form->create($user, ['class'=>'form-container add-user']) ?>
        <fieldset>
            <legend>ユーザの追加</legend>
            <div class="form-container-fields add-user">
                <?= $this->Form->input('id_string', ['label' => 'ID : ',]) ?>
                <?= $this->element('nameForm', ['form' => $this->Form]) ?>
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
