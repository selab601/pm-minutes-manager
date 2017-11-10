<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'minute.css',
        'minute-html.css',
        'lib/bootstrap.min.css'
        ]) ?>
    <?= $this->Html->script([
        'lib/jquery.js',
        'lib/jquery-ui.min.js',
        'lib/bootstrap.min.js',
        'elementFromAbsolutePoint.js'
        ]) ?>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
