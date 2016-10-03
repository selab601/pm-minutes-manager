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
        <?= $this->html->css('main.css') ?>
        <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body class="home">
        <?= $this->element('header') ?>

        <div class="contents top">
            <div class="side-contents left top">
                <h3>更新履歴</h3>
                <div id="revision">
                    <ul>
                        <?=
                            $this->element('revision', [
                                'date' => '2016/10/04',
                                'contents' => ['v0.1.0 としてリリースしました'],
                            ]);
                        ?>
                    </ul>
                </div>

            </div>
            <div class="main-contents">
                <h3>議事録管理のススメ</h3>
            </div>
        </div>

    </body>
</html>
