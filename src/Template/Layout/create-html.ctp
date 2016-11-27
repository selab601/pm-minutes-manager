<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>印刷用ページ</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('minute.css', ['block' => true]) ?>
    <?= $this->Html->css('minute-html.css', ['block' => true]) ?>
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
