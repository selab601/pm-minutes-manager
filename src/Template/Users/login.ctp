<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="login-container-wrapper">
        <?= $this->Form->create($user, ['class' => 'login-container']) ?>
        <?= $this->Form->input('id_string', [
            'label' => 'ログインID :',
            ]) ?>
        <?= $this->Form->input('password', [
            'label' => 'パスワード :',
            ]) ?>
        <div class="login-container-footer">
            <div class="login-container-footer-content">
                <?= $this->Html->link('新規登録', ['action' => 'signup']) ?>
            </div>
            <div class="login-container-footer-content">
                <?= $this->Form->button('ログイン') ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

</body>
</html>
