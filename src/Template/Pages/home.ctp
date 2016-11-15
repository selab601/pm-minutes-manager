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
            <div class="main-contents home">
                <h3>不具合報告について</h3>
                <p>
                    不具合を発見した場合は，Slack か メール で報告をいただければ対応します．<br>

                </p>
                <center style="margin-bottom: 15px;">
                    <h4><b>Slack</b></h4>
                    <p>
                        Slackは便利なチャットツールです．下記画像リンクをクリックしメールアドレスを入力すると招待メールが届きます．<br>
                        不具合報告だけでなく，何かわからないことがあれば遠慮なく質問してください．<br>
                        デスクトップアプリやスマホアプリもあるので，インストールをおすすめします．
                    </p>
                    <?= $this->Html->image('Slack.png', ['url' => "https://sheltered-crag-52727.herokuapp.com/"]) ?>
                </center>
                <center>
                    <h4><b>E-mail</b></h4>
                    <p>
                        本アプリ作者の M2 兎澤 のメールアドレスです．<br>
                        正直 Slack の方が対応が楽です(チャットでやりとりできるので)
                    </p>
                    <p><a href="mailto:15nm722x&#64;vc.ibaraki.ac.jp">15nm722x&#64;vc.ibaraki.ac.jp</a></p>
                </center>
            </div>
        </div>

    </body>
</html>
