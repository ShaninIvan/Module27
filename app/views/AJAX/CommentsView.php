<?php
    if(!empty($this->result)){
        foreach($this->result as $comment):

?>
    <div class="comment">
            <div class="comment__author"><?php echo $comment->author_name; ?>:</div>
            <div class="comment__body"><?php echo $comment->body; ?></div>
            <?php
                if($comment->author_name == $_SESSION['userName']){
                    echo '<div class="comment__delete">Удалить комментарий<span class="commentID">' . $comment->id . '</span></div>';
                }
            ?>

    </div>
<?php
        endforeach;}
?>
