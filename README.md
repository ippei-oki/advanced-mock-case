# 飲食店予約システム
メールアドレスとパスワードでログインし、飲食店の検索・予約を行う
![image](https://github.com/user-attachments/assets/ef9bf508-d56e-48bb-8607-0df27f72194f)

## 作成した目的
顧客の利便性向上及び集客力向上

## アプリケーションURL
https://github.com/ippei-oki/advanced-mock-case

## 機能一覧
・会員登録 ・ログイン ・ログアウト ・ユーザー情報取得 ・ユーザー飲食店お気に入り一覧取得
・ユーザー飲食店予約情報取得 ・飲食店一覧取得 ・飲食店詳細取得 ・飲食店お気に入り追加
・飲食店お気に入り削除 ・飲食店予約情報追加 ・飲食店予約情報削除 ・エリアで検索する
・ジャンルで検索する ・店名で検索する

## 使用技術（実行環境）
・Laravel 8.83.27　・NGINX 1.21.1　・PHP 8.3.7　・MySQL 8.0.26

## テーブル設計
![image](https://github.com/user-attachments/assets/b02e91b6-1f14-4ace-b2e5-5f71202432be)

## ER図
![image](https://github.com/user-attachments/assets/ab1c673f-5dea-45ba-97e7-78b5273f956d)

## 環境構築
**Dockerビルド**
1. `git clone git@github.com/ippei-oki/advanced-mock-case.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```
6. マイグレーションの実行
``` bash
php artisan migrate
```
7. シーディングの実行
``` bash
php artisan db:seed
```
