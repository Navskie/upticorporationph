<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_GET['id'];

    $delete = mysqli_query($connect, "DELETE FROM web_cart WHERE id = '$id'");

    header('location: ../shop.php');

?>