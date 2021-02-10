<?php
    // Корень сайта
    define('ROOT', dirname(__DIR__));

    // Подключение конфигурации
    include(ROOT . '/app/config/config.php');

    // Подключение ядра
    spl_autoload_register(function($class){
        include(CORE . "$class.php" );
    });

    // Вызов защиты и экранизация содержимого $_POST
    $defender = new Defender();
    $defender->hscPost();

    session_start();

    // Если пользователь впервые на сайте, то ему присваевается статус гостя
    if (!array_key_exists('userStatus', $_SESSION)){
        $_SESSION['userStatus'] = 'guest';
    }

    // Вызов и старт роутера
    $router = new Router;
    $router->run();
?>
