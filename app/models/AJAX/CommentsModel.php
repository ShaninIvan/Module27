<?php
    class CommentsModel{

        public function __construct()
        {
            $this->db = new Database;
        }
        
        public function getResult($action, $values){
            $comment = $values['comment'];
            $author = $values['author'];
            $imageID = $values['imageID'];
            $commentID = $values['commentID'];
    
            if($action == 'send'){
                $this->db->db_comments_add($comment, $author, $imageID);
            }

            if($action == 'delete'){
                $this->db->db_comments_delete($commentID, $author);
            }
            
            return $this->db->db_comments_list($imageID);
        }
    }
?>
