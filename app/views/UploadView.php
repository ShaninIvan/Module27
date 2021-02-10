<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузить изображение</title>
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
            <h2>Загрузить изображение</h2>
            <form class="upload-container" action="" method="POST" enctype="multipart/form-data">
                <div class="upload__inputs">
                    <div class="upload__rest">Выберите изображение на вашем компьютере. <br> Оно должно соответствовать следующим ограничениям:<br>
                        <ul>
                            <li><b>Тип файла:</b> <?php echo implode(', ', UPLOAD_TYPES) ?></li>
                            <li><b>Максимальный размер файла:</b> <?php echo round(UPLOAD_MAX_SIZE/1048576, 2) . 'Мб' ?></li>
                        </ul>
                    </div>
                    <input type="file" name="image" id="upload-image">
                    <button type="submit" name="submit" id="upload-btn" value="upload">Отправить</button>
                </div>
                <div class="upload__preview">
                <h3>Превью изображения:</h3>
                <div class="preview__info">
                    <div class="info__type"></div>
                    <div class="info__size"></div>
                </div>
                <canvas class="preview__canvas" height='320' width='480'></canvas>
                </div>
            </form>
        </main>
        <footer>
            <?php
                include_once(TEMPLATES . 'footer.inc');
            ?>
        </footer>
    </div>
    <script>
        const selectFile = document.querySelector('#upload-image');
        const btnUpload = document.querySelector('#upload-btn');
        const infoType = document.querySelector('.info__type');
        const infoSize = document.querySelector('.info__size');
        const canvas = document.querySelector('.preview__canvas');
        const canvasContext = canvas.getContext('2d');

        selectFile.addEventListener('change', function(){
            const type = this.files[0].type;
            const size = this.files[0].size;

            infoType.innerText = 'Тип файла: ' + type;
            infoSize.innerText = 'Размер файла: ' + (size/1048576).toFixed(2) + ' Мб';

            canvasContext.clearRect(0, 0, canvas.clientWidth, canvas.clientHeight);
            const fReader = new FileReader();
            fReader.readAsDataURL(this.files[0]);
            fReader.onloadend = (event) =>{
                const img = new Image();
                img.onload = () =>{
                const resHeight = 320;
                const resWidth = Math.round(img.width/(img.height/resHeight));
                canvas.width = resWidth;
            
                canvasContext.drawImage(img, 0, 0, resWidth, resHeight);
                }
            img.src = event.target.result;
            }  
        });
        
    </script>
</body>
</html>