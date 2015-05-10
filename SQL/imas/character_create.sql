-- アイドルマスター キャラクターデータ
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `imas_characters`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `imas_characters`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `type` VARCHAR(100) NOT NULL COMMENT "キャラクターの所属",
       `ch_name` VARCHAR(50) NOT NULL COMMENT 'キャラクターのフルネーム',
       `ch_name_ruby` VARCHAR(100) NOT NULL COMMENT 'アイドルのフルネームのよみがな',
       `ch_family_name` VARCHAR(20) NOT NULL COMMENT 'キャラクターの苗字',
       `ch_family_name_ruby` VARCHAR(50) NOT NULL COMMENT 'キャラクターの苗字のよみがな',
       `ch_first_name` VARCHAR(20) NOT NULL COMMENT 'キャラクターの名前',
       `ch_first_name_ruby` VARCHAR(50) NOT NULL COMMENT 'キャラクターの名前のよみがな',
       `ch_birth_month` INT NOT NULL COMMENT 'キャラクターの誕生月',
       `ch_birth_day` INT NOT NULL COMMENT 'キャラクターの誕生日',
       `ch_gender` INT NOT NULL COMMENT 'キャラクターの性別 0:男 1:女',
       `is_idol` BOOLEAN NOT NULL COMMENT 'アイドルかどうか',
       `ch_blood_type` VARCHAR(10) DEFAULT ' ' COMMENT '血液型',
       `ch_color` VARCHAR(20) DEFAULT ' '  COMMENT 'キャラクターのイメージカラー',
       `cv_name` VARCHAR(50) NOT NULL COMMENT '声優さんのフルネーム',
       `cv_name_ruby` VARCHAR(100) NOT NULL COMMENT '声優さんのフルネームのよみがな',
       `cv_family_name` VARCHAR(20) NOT NULL COMMENT '声優さんの苗字',
       `cv_family_name_ruby` VARCHAR(50) NOT NULL COMMENT '声優さんの苗字のよみがな',
       `cv_first_name` VARCHAR(20) NOT NULL COMMENT '声優さんの名前',
       `cv_first_name_ruby` VARCHAR(50) NOT NULL COMMENT '声優さんの名前のよみがな',
       `cv_birth_month` INT NOT NULL COMMENT '声優さんの誕生月',
       `cv_birth_day` INT NOT NULL COMMENT '声優さんの誕生日',
       `cv_gender` INT NOT NULL COMMENT '声優さんの性別 0:男 1:女',
       `cv_nickname` VARCHAR(50) DEFAULT ' ' COMMENT '声優さんの愛称',
       PRIMARY KEY(`id`)
)
COMMENT = 'キャラクターデータ';

SOURCE /var/www/html/api/SQL/imas/character_765.sql;