<?php
    class UploadModel{
        public function __construct()
        {
            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];

                $this->filename = $file['name'];
                $this->temppath = $file['tmp_name'];
                $this->size = $file['size'];
                $this->type = $file['type'];
            }
        }

        private function validate(){
            if (!isset($_FILES['image'])){
                $_SESSION['response'] = 'Ошибка загрузки файла';
                return false;
            }
            if($this->size>UPLOAD_MAX_SIZE){
                $_SESSION['response'] = 'Размер файла превышает допустимый';
                return false;
            }
            if(!in_array($this->type, UPLOAD_TYPES)){
                $_SESSION['response'] = 'Недопустимый тип файла';
                return false;
            }
        }

        public function actionRun(){
            if($this->validate() === false){
                return false;
            }

            $saltname = time() .  $this->filename;
            $db = new Database;
            
            if($db->db_gallery_create($saltname, $this->filename)){
                move_uploaded_file($this->temppath, UPLOAD_PATH . $saltname);
                $_SESSION['response'] = 'Файл загружен';
            }
        }
    }
?>
