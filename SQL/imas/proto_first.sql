-- アイドルマスター データベース作成

-- 各テーブルをクリエイト ソース先でデータの流し込みSQLをSOURCEする
SOURCE /var/www/html/api/SQL/imas/proto_create_idol.sql
SOURCE /var/www/html/api/SQL/imas/proto_create_cv.sql
SOURCE /var/www/html/api/SQL/imas/proto_create_nickname.sql
SOURCE /var/www/html/api/SQL/imas/proto_create_production.sql