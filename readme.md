Текущие настройки PDO:
- PDO_DSN: "mysql:host=database:3306;dbname=gallerydb"
- PDO_USER: "root"
- PDO_PASS: "1234"

Их можно изменить в app/config/config.php

Код создания таблиц находится в классе Database (app/core/Database.php). Можно скопировать его оттуда, или использовать метод класса "db_CreateTables()". 