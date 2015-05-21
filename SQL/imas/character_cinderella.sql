-- アイドルマスター キャラクターデータ シンデレラガールズ
SET NAMES utf8;
USE `fuel_dev`;

-- データの挿入
-- 島村卯月
INSERT INTO `imas_characters`
       (`type`, `ch_name`, `ch_name_ruby`, `ch_family_name`, `ch_family_name_ruby`, `ch_first_name`, `ch_first_name_ruby`, `ch_birth_month`, `ch_birth_day`, `ch_gender`, `is_idol`, `ch_blood_type`, `ch_color`, `cv_name`, `cv_name_ruby`, `cv_family_name`, `cv_family_name_ruby`, `cv_first_name`, `cv_first_name_ruby`, `cv_birth_month`, `cv_birth_day`, `cv_gender`, `cv_nickname`)
       VALUES
       ('シンデレラガールズ', '島村卯月', 'しまむらうづき', '島村', 'しまむら', '卯月', 'うづき', 4, 24, 1, true, 'O', 'ピンク', '大橋彩香', 'おおはしあやか', '大橋', 'おおはし', '彩香', 'あやか', 9, 13, 1, 'はっしー');
