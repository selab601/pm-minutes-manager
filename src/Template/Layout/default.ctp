<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('header') ?>

    <?= $this->fetch('content') ?>

    <div id="footer">
    </div>
</body>
</html>
