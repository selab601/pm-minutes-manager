# 議事録管理システム

講義「プロジェクトマネジメント論/演習」で使用する議事録管理用アプリケーションです．
この README.md は，開発者(研究室メンバ)向けに記述されたものですが，受講者の方々も，本システムを改善したい，参考にしたい等の要望があれば，以下の手順に従って本システムを動作させてみてください．

## ローカル環境で動かしたい場合には

本システムを改善，修正する際には，自分の PC 上で作業すると効率が良いと思います．
これを実現するため，インストール手順から説明していきます．

### PHP の準備

**自身の PC に既に PHP 7.x と，そのバージョンに対応した intl パッケージが導入されていれば，以下の作業は必要ありません．**

PHP のバージョンを確認します．[公式サイトの記述](http://book.cakephp.org/3.0/ja/quickstart.html) より，最低でも 5.5.9 以上が必要です．また，MySQL を使用するために， PHP で `pdo_mysql` が有効になっていること，`intl` プラグインが存在していることが必要となります．

ここでは，PHP 7 を例としてインストールします．macOS を使用している場合，インストールには [Homebrew](http://brew.sh/) を使用するのが良いでしょう．

``` shell
$ brew tap homebrew/php
$ brew install php71
$ brew install php71-intl
$ php -v
```

php のバージョンが 7.1 になっていない場合は，`/usr/local/bin` が優先的に読み込まれるように環境変数 PATH を設定してください．

### MySQL の準備

Homebrew によるインストールを終了します．インストール後は，MySQL サーバを起動し，MySQL サーバログインのためのユーザ名とパスワードを確認してください．
デフォルトのユーザ名は root であり，パスワードは設定されていません．
セキュリティ向上のため，適当なパスワードを設定しておくのが良いでしょう(これに関する解説は省きます)．

``` shell
# インストール
$ brew install mysql
# MySQL サーバの起動
$ mysql.server start
# 確認
$ mysql -uroot
...
# ログイン成功
mysql >
```

MySQL が起動できることを確認したら，CakePHP アプリケーション用のデータベースを作成しておきます
．MySQL サーバログイン後，適当な名前でデータベースを作成しておいてください．ここで作成したデータベース名は，後に使用します．

``` shell
mysql > create database <database_name>
```

### リポジトリのクローン

適当なディレクトリに本リポジトリをクローンします．

``` shell
$ git clone https://github.com/selab601/web_minutes
```

### CakePHP アプリケーションの設定

#### データベースの準備

CakePHP から データベースに接続するための設定を記述する必要があります．
CakePHP アプリケーションの設定ファイルは，clone したリポジトリ内に `config/app.php` として配置します．初めて clone した場合はこのファイルが存在しないため，既存の `config/app.default.php` をコピーして利用すると良いでしょう．
**app.php ファイルには機密情報が含まれるため，コミット，プッシュできません．今後もこの設定は変更しないようにしてください．**

``` shell
$ cd path/to/web_minutes
$ cp config/app.default.php config/app.php
```

次に，`app.php` の中身を編集します．220 行目あたりに，`Datasources` の項目があるので，ここを書き換えます．
データベース名は，先ほど作成したデータベース名を，ユーザ名とパスワードにはログイン可能なユーザ名，パスワードを設定します．

``` shell
'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            /**
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',
            'username' => 'my_app', <-- ここをかえる
            'password' => 'secret', <-- ここをかえる
            'database' => 'my_app', <-- ここをかえる
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
```

また，タイムゾーンを設定しないと，データベース内の時間がおかしくなります．
**こちらは設定しなくてもアプリは動作します**が，設定したければ以下のように設定してください．

まず，`config/app.php` の，先ほど編集した `Datasources` の一部を書き換えます．

``` shell
            ...
            'encoding' => 'utf8',
            'timezone' => 'Asia/Tokyo', <-- ここをかえる
            'flags' => [],
            ...
```

変更後，アプリケーションを起動すると，データベースエラーが発生する可能性があります．
以下のようなエラーが出力された場合，MySQL が Asia/Tokyo というタイムゾーンに対応していないことが原因です．

``` shell
SQLSTATE[HY000]: General error: 1298 Unknown or incorrect time zone: 'Asia/Tokyo'
```

対応させるためには，以下のようなコマンドを実行すると良いようです．ただし，環境によって必要な操作が異なる可能性があるので，適宜対応してください．

``` shell
mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root mysql -p
```

> 参考: [CaKePHP3 DBタイムゾーン設定 - Qiita](http://qiita.com/subaru/items/75c32fc6ef172215f599)

#### 依存パッケージの準備

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

**ログイン時等にデータベースエラーが発生する場合**は，`app.php` がコピーできているか，変更した設定は正しいか，MySQL サーバが動作しているかを確認してください．

## 研究室サーバ内の議事録管理システムの更新

**本節は研究室メンバ向けです．**
既に以前にダウンロードした議事録管理システムが研究室サーバ上で動作している場合に，そのアップデート手順について記述します．

1. `~/serverData/www` に移動します (`cd ~/serverData/www`)
2. 既存の `webminutes` ディレクトリ内の `config/app.php` を適当な場所に避難させます (`cp webminutes/config/app.php .`)
3. 既存の `webminutes` は，念のためにバックアップとしてリネームしておきます (`mv webminutes webminutes_`)
4. `git clone https://github.com/selab601/web_minutes` により最新のリポジトリをクローンします
5. ディレクトリ名をサーバ設定に合わせて変更します (`mv web_minutes webminutes`)
6. `app.php` を設置します (`mv app.php webminutes/config`)
7. `composer install` を実行します

**Webサーバやデータベースの再起動は必要ありません．**
動作確認を行います．
問題なければ，手順 2 でバックアップとして残した `webminutes_` は削除してしまって構いません．

## License

GPL v3.0
