<?php
    class DeleteModel{
        public function __construct()
        {
            $this->id = $_POST['image-id'];
            $this->authorID = $_SESSION['userID'];
            $this->currentFile = $_SESSION['currentFile'];
        }

        public function actionRun(){
            $db = new Database;
            if($db->db_gallery_delete($this->id, $this->authorID)){
                unlink(UPLOAD_PATH . $this->currentFile);
                $_SESSION['response'] = 'Файл удален';
            }
        }
    }
?>
