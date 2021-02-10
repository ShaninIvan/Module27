<?php
    class CommentsController{
        public function __construct()
        {
            $this->comment = $_POST['comment'];
            $this->author = $_SESSION['userName'];
            $this->imageID = $_POST['imageID'];
            $this->commentID = $_POST['commentID'];
        }    

        private function run($action, $values){
            require_once(MODELS . 'AJAX/CommentsModel.php');
            $model = new CommentsModel;
            $this->result = $model->getResult($action, $values);
            include_once(VIEWS . 'AJAX/CommentsView.php');
        }

        public function actionShow(){
            $values = array('imageID' => $this->imageID);
            $this->run('show', $values);
        }

        public function actionSend(){
            $values = array('comment' => $this->comment, 'author' => $this->author, 'imageID' => $this->imageID);
            $this->run('send', $values);
        }

        public function actionDelete(){
            $values = array('commentID' => $this->commentID, 'author' => $this->author, 'imageID' => $this->imageID);
            $this->run('delete', $values);
        }
    }
?>
