-- アイドルマスター キャラクターデータ
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `imas_nicknames`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `imas_nicknames`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `nickname` VARCHAR(100) NOT NULL COMMENT 'ニックネーム',
       `type` VARCHAR(50) NOT NULL COMMENT 'ニックネームタイプ',
       `idol_id` INT COMMENT 'ニックネーム紐付けキャラクターID',
       `cv_id` INT COMMENT 'ニックネーム紐付け声優ID',
       PRIMARY KEY(`id`)
)
COMMENT = 'ニックネームデータ';

-- 実データの流し込み
SOURCE /var/www/html/api/SQL/imas/others/nickname.sql
