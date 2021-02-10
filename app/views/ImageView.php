<?php
$info = $this->args['info'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр изображения</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <?php
            include_once(TEMPLATES . 'header.inc');
            ?>
        </header>
        <main class="main">
            <h2><?php echo $info->originalname ?></h2>
            <div class="viewing">
                <form class="viewing__image" action="/" method="POST">
                    <input type="hidden" name="image-id" id="image-id" value=<?php echo $info->id ?>>
                    <img src=<?php echo '/gallery/' . $info->filename ?> alt=<?php echo $info->originalname ?>>
                    <?php
                    if ($info->author_id == $_SESSION['userID']) {
                        include_once(TEMPLATES . 'removeImage.inc');
                    }
                    ?>

                </form>
                <div class="viewing__comments">
                    <h3>Комментарии:</h3>
                    <div class="comments__block"></div>
                    <?php
                    if ($_SESSION['userStatus'] == 'user') {
                        include_once(TEMPLATES . 'sendComment.inc');
                    }
                    ?>

                </div>
            </div>
        </main>
        <footer>
            <?php
            include_once(TEMPLATES . 'footer.inc');
            ?>
        </footer>
    </div>

    <script>
        class AJAXRequest {
            constructor(route, target, args = "") {
                this.route = route;
                this.args = args;
                this.target = target;
            }

            sendRequest() {
                this.body = 'AJAX=' + this.route + ((this.args !== '') ? ('&' + this.args) : '');
                fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: this.body
                    })
                    .then(response => {
                        return response.text();
                    })
                    .then(response => {
                        console.log(response);
                              
                        this.target.innerHTML = response;
                    })
            }
        }
    
    const commentsBlock = document.querySelector('.comments__block');
    const imageID = document.querySelector('#image-id');

    function requestComments(){
        const request = new AJAXRequest('comments-list', commentsBlock, 'imageID='+imageID.value);
        request.sendRequest();
    }

    document.addEventListener('load', requestComments());
    
    commentsBlock.addEventListener('click', (event)=>{

        if(event.target.getAttribute('class') === 'comment__delete'){
            const deleteComment = event.target;
            const commentID = deleteComment.querySelector('.commentID').innerText;
            const request = new AJAXRequest('comment-delete', commentsBlock, 'commentID='+commentID+'&imageID='+imageID.value);
            request.sendRequest();       
        }
    });
    </script>
</body>

</html>