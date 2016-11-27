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
    <link href='https://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="container">
        <?= $this->element('header') ?>

        <div id="content">
            <?= $this->fetch('content') ?>
        </div>

        <div class="footer">
            <p class="text-muted">© Copyright 2016 Software Engineering Ueda's Laboratory</p>
        </div>
    </div>
</body>
</html>
