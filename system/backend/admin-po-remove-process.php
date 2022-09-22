<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    $delete = "DELETE FROM stockist_po WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete);

    echo "<script>window.location.href='../ph-po.php';</script>";

?>