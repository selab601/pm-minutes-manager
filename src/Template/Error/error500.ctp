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
            <h3>技術的な問題が発生しています</h3>
            ご不便おかけします．解決しない場合は，Slack もしくは メール から連絡をお願いします(TOP参照)．
        </div>
    </div>
</body>
</html>
