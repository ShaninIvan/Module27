<?php
    class ImageModel extends Model{
        public function __construct()
        {
            $this->id = explode('/', $_SERVER['REQUEST_URI'])[2];
        }

        public function getResult(){
            $db = new Database;
            $info = $db->db_image_info($this->id);
            if(!$info){
                
                header('location: /');
                return false;
            }

            $_SESSION['currentFile'] = $info->filename;
            return array('info' => $info);
        }
    }
?>
