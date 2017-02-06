<?= $this->assign('title', 'ログイン') ?>
<?= $this->Html->script(['Minutes/on_focus.js'], ['block' => true]) ?>
<div class="login-container-wrapper">
    <?= $this->Form->create($user, ['class' => 'login-container']) ?>
    <?= $this->Form->input('id_string', [
        'label' => 'ログインID :',
        'id' => 1,
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
