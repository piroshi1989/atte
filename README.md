#アプリケーション名
勤怠管理のwebアプリケーション
勤務開始、勤務終了を記録することで勤務時間を算出できる
休憩時間があれば差し引いて勤務時間を算出できる

<トップ画像>

##作成した目的
COACHTECH Web開発初級案件

##アプリケーションURL
http://ec2-52-193-187-165.ap-northeast-1.compute.amazonaws.com/login

##他のリポジトリ
特になし

##機能一覧
ログイン機能
メール認証機能

##使用技術
Laravel 8.75
PHP 7.4.33
mysql 8.0.33
nginx 1.12.2

##テーブル設計
<画像>

##ER図

##環境構築
dockerでの環境構築
//コマンドライン上で以下のコマンドを入力
$ cd coachtech/laravel
$ git clone git@github.com:coachtech-material/laravel-docker-template.git
$ mv laravel-docker-template atte
$ cd atte
$ docker-compose up -d --build
$ docker-compose exec php bash
//PHPコンテナ上で以下のコマンドを入力
$ composer install
$ cp .env.example .env
$ exit

envファイルの以下の項目を修正
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

$ php artisan key:generate
$ php artisan migrate

EC2での環境構築
参考URL:https://brainlog.jp/server/aws/post-3246/  
        https://taishou.ne.jp/laravel-s3-connect/
        https://zenn.dev/sway/articles/aws_publish_create_rds

##他に記載することがあれば記述する
・EC2ではS3に接続できているか確認するため、/uploadでファイルアップロード画面を作成しています

・追加実装項目の環境の切り分けではテスト環境用のEC2インスタンスを作成しました
RDSは別のインスタンスを接続しました
URL:http://ec2-18-177-5-172.ap-northeast-1.compute.amazonaws.com/login

・開発でメール認証はMailTrapのダミーのSMTPサーバを使用してテストしました
　githubではweb.phpの24行目をコメントアウトして認証しなくてもトップ画面に移行できるようにしています

・ユーザーページではユーザー名をクリックすると勤怠記録のテーブルが表示されます