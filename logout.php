<?php
    session_start();

    $_SESSION['status'] = 'invalid';

    unset($_SESSION['uid']);
    unset($_SESSION['role']);
    unset($_SESSION['code']);

    header('Location: index.php');
?>