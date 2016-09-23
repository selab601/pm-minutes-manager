<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$cakeDescription = '議事録管理システム';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body class="home">

        <?= $this->element('header') ?>
    </body>
</html>
