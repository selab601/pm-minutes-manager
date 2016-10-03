<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>
    <?= $this->Html->script(['jquery.js', 'bootstrap.min.js']) ?>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="contents">
        <div class="main-contents">
            <h3>404 Not Found</h3>
            該当ページが見つかりません．
        </div>
    </div>
</body>
</html>
