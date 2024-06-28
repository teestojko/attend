# attend
出勤、退勤、休憩時間を打刻し、ユーザー毎に日付別の実質労働時間を把握、

管理できる機能を実装したアプリケーション
![alt text](image.png)

## 作成した目的
全ての社員の労働時間をアプリケーションで管理し、人事評価に繋げるため

## アプリケーションのURL
https://github.com/teestojko/attend.git

## 他のリポジトリ
なし

## 機能一覧
fortifyログイン機能

出勤、退勤、休憩開始、休憩終了の打刻機能

出勤時間から休憩時間を引いた実質労働時間の検索機能

## 使用技術（実行環境）
laravel 8.83.27

php 7.4.9

html 5

css 3

## テーブル設計

<img width="496" alt="スクリーンショット 2024-06-28 21 06 19" src="https://github.com/teestojko/attend/assets/158604040/f4d6ff69-fe5c-4fe0-92b5-01ddabc6096d">


## ER図

<img width="663" alt="スクリーンショット 2024-05-26 17 35 29" src="https://github.com/teestojko/attend/assets/158604040/c5f238cd-c0f1-4a67-8042-3de0c995ba83">



# 環境構築

git clone git@github.com:teestojko/template.git

### 名前変更

mv template Atte

### プロジェクトのルートディレクトリ(Atte)に移動して、

⬇️

git remote set-url origin https://github.com/teestojko/attend.git

(作成されたgitのURLを、下記のoriginの後ろに記述)

### docker作成＆起動

docker-compose up -d --build

composer install

php artisan key:generate



### .envの作成、記述変更

cp .env.example .env



##### .env

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass



### ダミーデータ挿入(例:Author)

php artisan make:migration create_authors_table

php artisan make:model Author

php artisan make:factory AuthorFactory

php artisan make:seeder AuthorsTableSeeder



##### (適宜挿入したいダミーデータを記述)

php artisan migrate

php artisan db:seed
