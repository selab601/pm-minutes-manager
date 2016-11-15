<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->html->css('jquery-ui.min.css') ?>
    <?= $this->html->css('jquery-ui.theme.min.css') ?>
    <?= $this->html->css('jquery-ui.structure.min.css') ?>
    <?= $this->Html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>

    <!-- minute/add, edit -->
    <?= $this->html->css('jquery.datetimepicker.css') ?>
    <?= $this->html->script(['jquery.datetimepicker.full.js']) ?>

    <!-- create-html -->
    <?= $this->html->css('minute.css') ?>
    <?= $this->html->css('minute-html.css') ?>
    <?= $this->html->script(['elementFromAbsolutePoint.js']) ?>
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

    <!-- projects/add, edit -->
    <?= $this->html->script(['toggleRoleList.js']) ?>

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
