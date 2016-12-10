<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'main.css',
        'lib/bootstrap.min.css'
        ]) ?>
    <?= $this->Html->script([
        'lib/jquery.js',
        'lib/jquery-ui.min.js',
        'lib/bootstrap.min.js',
        ]) ?>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="container">
        <?= $this->element('header') ?>

        <?= $this->fetch('content') ?>

        <div class="footer">
            <p>© Copyright 2016 Software Engineering Ueda's Laboratory</p>
        </div>
    </div>
</body>
</html>
