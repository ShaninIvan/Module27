<?php
    $gallery = $this->args['gallery'];
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея изображений</title>
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
            <h2>Просмотр изображений</h2>
            <div class="gallery-wrapper">
            <?php
                if(!empty($gallery)){
                foreach ($gallery as $image) :
                    ?>
                        <figure class="image">
                        <a href=<?php echo '/image/' . $image->id ?>>
                        <img src=<?php echo '/gallery/' . $image->filename ?> alt=<?php echo $image->originalname ?>>
                        </a>
                            <figcaption class="image__caption"><?php echo $image->originalname ?></figcaption>
                        </figure>
                    <?php
                    endforeach;}
            ?>
            </div>
        </main>
        <footer>
            <?php
            include_once(TEMPLATES . 'footer.inc');
            ?>
        </footer>
    </div>
</body>

</html>