<?php
    // Константы путей
    define('CORE', ROOT . '/app/core/');
    define('CONTROLLERS', ROOT . '/app/controllers/');
    define('MODELS', ROOT . '/app/models/');
    define('VIEWS', ROOT . '/app/views/');
    define('TEMPLATES', ROOT . '/app/templates/');

    // Параметры PDO
    define('PDO_DSN', "mysql:host=database:3306;dbname=gallerydb");
    define('PDO_USER', 'root');
    define('PDO_PASS', '1234');
    define('PDO_OPTION', [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => true,
    ]);

    // Ограничения пользователей
    define('USER_LOGIN_LENGTH', 30);
    define('USER_PASSWORD_LENGTH', 20);

    //Upload
    define('UPLOAD_MAX_SIZE', 3670016); // 3mb
    define('UPLOAD_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
    define('UPLOAD_PATH', ROOT . '/public/gallery/');
?>
