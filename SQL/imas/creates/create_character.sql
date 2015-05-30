-- アイドルマスター キャラクターデータ
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `imas_characters`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `imas_characters`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `production_id` INT COMMENT 'プロダクションID',
       `cv_id` INT COMMENT '声優ID',
       `name` VARCHAR(50) NOT NULL COMMENT 'キャラクター名',
       `name_ruby` VARCHAR(100) NOT NULL COMMENT 'キャラクター名ふりがな',
       `family_name` VARCHAR(50) NOT NULL COMMENT 'キャラクター苗字',
       `family_name_ruby` VARCHAR(100) NOT NULL COMMENT 'キャラクター苗字ふりがな',
       `first_name` VARCHAR(50) NOT NULL COMMENT 'キャラクター名前',
       `first_name_ruby` VARCHAR(100) NOT NULL COMMENT 'キャラクター名前ふりがな',
       `birth_month` INT NOT NULL COMMENT '誕生月',
       `birth_day` INT NOT NULL COMMENT '誕生日',
       `gender` VARCHAR(20) NOT NULL COMMENT '性別 male or female',
       `is_idol` INT NOT NULL COMMENT 'アイドルか 0:そうでない 1:そうである',
       `blood_type` VARCHAR(10) COMMENT '血液型',
       `color` VARCHAR(20) COMMENT 'キャラの色', 
       `type` VARCHAR(20) COMMENT 'アイドル属性',
       PRIMARY KEY(`id`)
)
COMMENT = 'キャラクターデータ';

-- 実データの流し込み
SOURCE /var/www/html/api/SQL/imas/characters/character_765.sql
