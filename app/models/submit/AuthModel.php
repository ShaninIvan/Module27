<?php
    class AuthModel{
        public function __construct()
        {
            $this->login = $_POST['userLogin'];
            $this->password = $_POST['userPassword'];
        }

        private function validate(){
            if ($this->login == ''){
                $_SESSION['response'] = 'Вы не ввели логин';
                return false;
            }

            if ($this->password == ''){
                $_SESSION['response'] = 'Вы не ввели пароль';
                return false;
            }
        }
        
        public function actionUp(){
            if ($this->validate() === false){
                return false;
            }

            $db = new Database;
            if (!$db->db_users_find($this->login)){
                if($db->db_users_create($this->login, $this->password)){
                    $_SESSION['response'] = 'Регистрация завершена';
                }
            }else{
                $_SESSION['response'] = 'Такой пользователь уже существует';
            }
        }

        public function actionIn(){
            if ($this->validate() === false){
                return false;
            }

            $db = new Database;
            $user = $db->db_users_find($this->login);
            if ($user){
                if (password_verify($this->password, $user->password)){
                    $_SESSION['userName'] = $user->login;
                    $_SESSION['userID'] = $user->id;
                    $_SESSION['userStatus'] = 'user';
                    $_SESSION['response'] = 'Добро пожаловать!';
                }else{
                    $_SESSION['response'] = 'Неправильный пароль';
                }
            }else{
                $_SESSION['response'] = 'Пользователя с таким именем не существует';
            }
        }

        public function actionOut(){
            $_SESSION['userStatus'] = 'guest';
            $_SESSION['userName'] = null;
            $_SESSION['userID'] = null;
            $_SESSION['response'] = 'Выход завершен';
        }
    }
?>
