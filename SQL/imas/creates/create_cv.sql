-- アイドルマスター キャラクターデータ
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `imas_cvs`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `imas_cvs`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `name` VARCHAR(50) NOT NULL COMMENT '声優名',
       `name_ruby` VARCHAR(100) NOT NULL COMMENT '声優名ふりがな',
       `family_name` VARCHAR(50) NOT NULL COMMENT '声優苗字',
       `family_name_ruby` VARCHAR(100) NOT NULL COMMENT '声優苗字ふりがな',
       `first_name` VARCHAR(50) NOT NULL COMMENT '声優名前',
       `first_name_ruby` VARCHAR(100) NOT NULL COMMENT '声優名前ふりがな',
       `birth_month` INT NOT NULL COMMENT '誕生月',
       `birth_day` INT NOT NULL COMMENT '誕生日',
       `gender` VARCHAR(20) NOT NULL COMMENT '性別 male or female',
       `is_active` INT NOT NULL COMMENT '活動中か 0:そうでない 1:そうである',
       PRIMARY KEY(`id`)
)
COMMENT = '声優データ';

-- 実データの流し込み
SOURCE /var/www/html/api/SQL/imas/others/cv.sql
