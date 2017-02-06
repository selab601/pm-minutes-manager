# 議事録管理システム

講義 プロジェクトマネジメント論/演習 で使用する議事録管理用アプリケーションです．

## Update

既に以前にダウンロードした議事録管理システムがサーバ上で動作している場合のアップデート手順について記述します．

1. `~/serverData/www` に移動します (`cd ~/serverData/www`)
2. 既存の `webminutes` ディレクトリ内の `config/app.php` を適当な場所に避難させます (`cp webminutes/config/app.php .`)
3. 既存の `webminutes` は，念のためにバックアップとしてリネームしておきます (`mv webminutes webminutes_`)
4. `git clone https://github.com/selab601/web_minutes` により最新のリポジトリをクローンします
5. ディレクトリ名をサーバ設定に合わせて変更します (`mv web_minutes webminutes`)
6. `app.php` を設置します (`mv app.php webminutes/config`)
7. `composer install` を実行します

動作確認を行います．
問題なければ，手順 2 でバックアップとして残した `webminutes_` は削除してしまって構いません．
Webサーバやデータベースの再起動は必要ありません．

## Install

本システムを初めてインストールする場合の手順について記述します．

### PHP の準備

PHP のバージョンを確認します．[公式サイトの記述](http://book.cakephp.org/3.0/ja/quickstart.html) より，最低でも 5.5.9 以上が必要です．また，MySQL を使用するために， PHP で `pdo_mysql` が有効になっていること，`intl` プラグインが存在していることが必要となります．

ここでは，PHP 7 を例としてインストールします．macOS を使用している場合，インストールには [Homebrew](http://brew.sh/) を使用するのが良いでしょう．

``` shell
$ brew tap homebrew/php
$ brew install php71
$ brew install php71-intl
$ php -v
```

php のバージョンが 7.1 になっていない場合は，`/usr/local/bin` が優先的に読み込まれるように環境変数 PATH を設定してください．

### リポジトリのクローン

`~/serverData/www` 以下にリポジトリをクローンします．
このパスにクローンする理由は，[研究室サーバのREADME](https://github.com/selab601/serverEnv)を参考にしてください．

``` shell
$ cd ~/serverData/www
$ git clone https://github.com/selab601/web_minutes
# フォルダ名を変更します．
$ mv web_minutes webminutes
```

### CakePHP アプリケーションの設定

次に，接続先データベース名，パスワード等を記述した `app.php` をコピーします．
機密情報を含むため，このファイルは研究室サーバローカルにのみ存在します．
研究室サーバ環境以外でとりあえず動作させる場合は，`app.default.php` を `app.php` にリネームし，データベースの設定を追記して使用してください．

``` shell
$ cd webminutes
$ cp /path/to/app.php config/
```

最後に，依存するプラグイン類を composer を使用してダウンロードします．
composer が存在しない場合はまず composer をインストールします．

``` shell
$ curl -s https://getcomposer.org/installer | php
```

その後，プラグイン群のダウンロードを行います．
ダウンロード後，パーミッションの設定を自動で行うか問われるので，`Y`と答えてください．

``` shell
$ php composer.phar install
```

これで準備は完了です．

### 動作確認

以下のコマンドで簡易的な Web サーバを立ち上げることができます．

``` shell
$ bin/cake server
```

`localhost:8765` にアクセスし，サイト TOP ページが表示されるか確認してください．
ログイン時等にデータベースエラーが発生する場合は，`app.php` がコピーできているか，MySQL が動作しているか等を確認してください．

## License

GPL v3.0
