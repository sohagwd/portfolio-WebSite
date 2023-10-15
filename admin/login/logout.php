<?php 
    ob_start();
    session_start();
    session_unset();
    session_destroy();
    setcookie('login_user', $user_login_id, time() - 60*60, '/');
    header('location: login.php');
    ob_end_flush();
?>