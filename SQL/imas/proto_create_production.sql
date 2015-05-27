-- アイドルマスター キャラクターデータ
SET NAMES utf8;
USE `fuel_dev`;

-- 既存テーブルの削除
DROP TABLE IF EXISTS `imas_productions`;

-- テーブル定義
CREATE TABLE IF NOT EXISTS `imas_productions`(
       `id` INT NOT NULL AUTO_INCREMENT COMMENT '連番ID',
       `name` VARCHAR(100) COMMENT 'プロダクション名',
       `president` VARCHAR(50) COMMENT '代表者名',
       PRIMARY KEY(`id`)
)
COMMENT = 'プロダクションデータ';

-- 実データの流し込み
SOURCE /var/www/html/api/SQL/imas/proto_production.sql