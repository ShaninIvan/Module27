<?php
$userName = 'Гость';

if ($_SESSION['userStatus'] !== 'guest') {
    $userName = $_SESSION['userName'];
}
?>


<span>Привет, <?php echo $userName ?>!</span>
<div class="user-panel__controls">
    <?php
    if ($_SESSION['userStatus'] === 'guest') {
        include_once(TEMPLATES . '/userPanel_auth.inc');
    } else {
        include_once(TEMPLATES . '/userPanel_user.inc');
    }
    ?>
</div>
<div class="response">
    <?php 
        echo $_SESSION['response'];
        $_SESSION['response'] = '';
    ?>
</div>
