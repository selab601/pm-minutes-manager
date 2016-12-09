<?php
    $this->assign('title', '議事録管理システム');
?>
<div id="description">
    <div id="box">
        <h1>ようこそ</h1>
        <p>
            議事録管理システムは，上田研究室の学生が開発，運営している，PM論受講者のためのWebアプリケーションです．
        </p>
        <p>
            初めて利用する方は，まず以下の <b>Slack</b> と <b>GitHub</b> に関する説明を <b style="color:red;">必ず</b> 一読してください．
        </p>
    </div>
</div>

<div class="app-container-wrapper">
    <div class="app-container">
        <h2 class="app-name">Slack</h2>
        <div class="app-icon-wrapper col-centered">
            <?= $this->Html->image('Slack.png', ['url' => "https://sheltered-crag-52727.herokuapp.com/", 'class'=>'app-img']) ?>
        </div>
        <p>
            Slack を通じて，TAの方々との交流したり，報告，アドバイスを受け取ることができます．
            <b>PM論受講者は，必ず登録してください．</b>
            <h4><a href="https://sheltered-crag-52727.herokuapp.com">Slack に登録する</a></h4>
        </p>
        <p>
            登録後は，環境に応じたアプリケーションをダウンロードしてください．
        </p>
        <div class="slack-versions">
            <div class="slack-version"><a href="https://itunes.apple.com/us/app/slack-team-communication/id618783545?mt=8">iOS</a></div>
            <div class="slack-version"><a href="https://play.google.com/store/apps/details?id=com.Slack&hl=en">android</a></div>
            <div class="slack-version"><a href="https://slack.com/downloads/windows">Windows</a></div>
            <div class="slack-version"><a href="https://itunes.apple.com/us/app/slack/id803453959?mt=12">Mac</a></div>
        </div>
    </div>
    <div class="app-container">
        <h2 class="app-name">Github</h2>
        <div class="app-icon-wrapper col-centered">
            <?= $this->Html->image('Github.png', ['url' => "https://github.com/selab601/web_minutes", "class"=>"app-img"]) ?>
        </div>
        <p>
            議事録管理システムは，GitHub でソースコードを公開している OSS であり，上田研究室の学生によって管理，開発されています．開発言語は PHP，フレームワークに CakePHP 3 を使用しています．
            <h4><a href="https://github.com/selab601/web_minutes">ソースコードを見る</a></h4>
        </p>
        <p>
            システムを利用中に問題が生じた場合には，issue 機能を活用し報告してください．
            もしくは，Slack の #problem チャンネルで報告してください．
            また，改善案があればぜひ提出してください．
        </p>
        <p><h4><a href="https://github.com/selab601/web_minutes/issues">問題を報告する / 改善案を提出する</a></h4></p>
    </div>
</div>
