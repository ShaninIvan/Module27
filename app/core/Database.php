<?php
    class Database{
        public function __construct()
        {
            $this->connect = new PDO(PDO_DSN, PDO_USER, PDO_PASS, PDO_OPTION);
        }

        //  Создание необходимых таблиц. Для удобства тестирования
        public function db_CreateTables(){
            $loginLength = USER_LOGIN_LENGTH;

            $sqlUsers = "CREATE TABLE IF NOT EXISTS `Users` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `login` varchar($loginLength) NOT NULL,
                `password` varchar(255) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `login` (`login`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";

            $this->connect->exec($sqlUsers);

            $sqlGallery = "CREATE TABLE `Gallery` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `filename` varchar(255) NOT NULL,
                `originalname` varchar(255) NOT NULL,
                `author_id` int unsigned DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `filename` (`filename`),
                KEY `author_id` (`author_id`),
                CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";

            $this->connect->exec($sqlGallery);

            $sqlComments = "CREATE TABLE `Comments` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `body` text NOT NULL,
                `author_name` varchar($loginLength) DEFAULT NULL,
                `image_id` int unsigned NOT NULL,
                PRIMARY KEY (`id`),
                KEY `author_name` (`author_name`),
                KEY `image_id` (`image_id`),
                CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`author_name`) REFERENCES `Users` (`login`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `Gallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";

              $this->connect->exec($sqlComments);
        }

        // Поиск пользователя в таблице Users
        public function db_users_find($login){
            $sql = 'SELECT * FROM Users WHERE `login` = ?';
            $stmt = $this->connect->prepare($sql);
            $data = array($login);
            $stmt->execute($data);
            return $stmt->fetch();
        }

        // Добавление пользователя в таблицу Users
        public function db_users_create($login, $password){
            $sql = 'INSERT INTO Users (`login`, `password`) VALUES (?, ?)';
            $stmt = $this->connect->prepare($sql);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data = array($login, $password);
            return $stmt->execute($data);
        }

        // Добавление записи о новом файле
        public function db_gallery_create($filename, $originalname){
            $sql = 'INSERT INTO Gallery(`filename`, `originalname`, `author_id`) VALUES (?, ?, ?);';
            $stmt = $this->connect->prepare($sql);
            $data = array($filename, $originalname, $_SESSION['userID']);
            return $stmt->execute($data);
        }

        //Удаление записи о файле
        public function db_gallery_delete($id, $authorID){
            $sql="DELETE FROM `Gallery` WHERE (`id`=?) AND (`author_id`=?);";
            $stmt = $this->connect->prepare($sql);
            $data = array($id, $authorID);
            return $stmt->execute($data);
        }

        // Получение списка изображений
        public function db_gallery_list(){
            $sql = "SELECT Gallery.id, Gallery.filename, Gallery.originalname FROM Gallery;";

            $result =$this->connect->query($sql);
            return $result->fetchAll();
        }

        //Получение информации об изображении
        public function db_image_info($id){
            $sql = "SELECT * FROM Gallery WHERE `id`=?;";
            $stmt = $this->connect->prepare($sql);
            $data = array($id);
            $stmt->execute($data);
            return $stmt->fetch();
        }

        // Список комментариев по ID изображения
        public function db_comments_list($imageID){
            $sql = "SELECT `id`, `body`, `author_name` FROM `Comments` WHERE `image_id` = ?;";
            $stmt = $this->connect->prepare($sql);
            $data = array($imageID);
            $stmt->execute($data);
            return $stmt->fetchAll();
        }

        // Добавление комментария
        public function db_comments_add($body, $author, $imageID){
            $sql = "INSERT INTO `Comments`(`body`, `author_name`, `image_id`) VALUES (?, ?, ?);";
            $stmt = $this->connect->prepare($sql);
            $data = array($body, $author, $imageID);
            return $stmt->execute($data);
        }

        // Удаление комментария
        public function db_comments_delete($commentID, $author){
            $sql = "DELETE FROM `Comments` WHERE (`id`= ?) AND (`author_name` = ?);";
            $stmt = $this->connect->prepare($sql);
            $data = array($commentID, $author);
            return $stmt->execute($data);
        }
    }
?>
