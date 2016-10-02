<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?= $this->element('formContainerTemplate') ?>
        <?= $this->Form->create($user, ['class'=>'form-container add-user']) ?>
        <fieldset>
            <legend>ユーザの編集</legend>
            <div class="form-container-fields add-user">
                <?= $this->Form->input('id_string', ['label'=>'ID : ']) ?>
                <?= $this->element('nameForm', ['form' => $this->Form]) ?>
                <?= $this->Form->input('password', [
                    'value' => "",
                    'placeholder' => '新しいパスワードを入力',
                    'required' => false,
                    'label' => 'パスワード : ',
                    ]) ?>
                <?= $this->Form->input('mail', ['label'=>'メールアドレス : ']) ?>
            </div>
        </fieldset>
        <div class="form-container-footer">
            <?= $this->Form->button("決定") ?>
        </div>
        <?= $this->Form->end() ?>
    </body>
</html>
