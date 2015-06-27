-- 声優シャンプー データテーブル
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `sh_cv_list`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `sh_cv_list`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `sh_id` INT NOT NULL COMMENT 'シャンプーID',
       `name` VARCHAR(50) NOT NULL COMMENT '声優名',
       PRIMARY KEY(`id`)
)
COMMENT = 'シャンプーAPI 声優テーブル';

-- 実データの流し込み
SOURCE /var/www/html/api/SQL/shampoo/datas/data_cv.sql