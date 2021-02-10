<textarea id="comment-area" rows="5", cols="70">

</textarea>
<button id="comment-send">Отправить комментарий</button>

<script>
    const btnSend = document.querySelector('#comment-send');
    const textArea = document.querySelector('#comment-area');

    btnSend.addEventListener('click', ()=>{
        const text = 'comment=' + textArea.value + '&imageID=' + imageID.value;
        request = new AJAXRequest('comment-send', commentsBlock, text);
        request.sendRequest();
    })
</script>