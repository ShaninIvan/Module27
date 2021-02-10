<?php
    class GalleryModel extends Model{
        public function getResult(){
            $db = new Database;
            return array('gallery' =>$db->db_gallery_list());
        }
    }
?>
