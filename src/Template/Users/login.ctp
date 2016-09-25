<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="container">

        <h1>Login</h1>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('id_string') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->button('Login') ?>
        <?= $this->Form->end() ?>
    </div>
</body>
</html>
