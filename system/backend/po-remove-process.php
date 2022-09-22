<?php
    session_start();
    include '../dbms/conn.php';
    
    $role = $_SESSION['role'];

    $id = $_GET['id'];

    $delete = "DELETE FROM stockist_po WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete);

    if ($role != 'UPTIMAIN') {
        echo "<script>window.location.href='../stockist-po.php';</script>";
    } else {
        echo "<script>window.location.href='../ph-po.php';</script>";
    }

    

?>