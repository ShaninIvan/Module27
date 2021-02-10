<?php
    $URIRoutes = [
        // В качестве ключей используются регулярные выражения (только само выражение, без огра)
        '/upload' => 'Upload/show', // строго /upload
        '/image/[0-9]+' => 'Image/show', // /image/ + любые цифры, подразумевающие ID изображения в БД
        '/.*' => 'Gallery/show' // любой другой URI. Такой паттерн всегда должен указываться последним.
    ];

    $submitRoutes = [
        'signUp' => 'Auth/up',
        'signIn' => 'Auth/in',
        'signOut' => 'Auth/out',
        'upload' => 'Upload/run',
        'delete' => 'Delete/run'
    ];

    $AJAXRoutes = [
        'comments-list' => 'Comments/show',
        'comment-send' => 'Comments/send',
        'comment-delete' => 'Comments/delete'
        
    ];

    return array('URIRoutes' => $URIRoutes, 'submitRoutes' => $submitRoutes, 'AJAXRoutes' => $AJAXRoutes);
?>
