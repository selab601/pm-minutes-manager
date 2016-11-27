<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('minute.css') ?>
    <?= $this->Html->css('minute-html.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>
    <?= $this->Html->script(['elementFromAbsolutePoint.js'],  ['block' => true]) ?>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
