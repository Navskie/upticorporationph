<?php

    include '../dbms/conn.php';

    $id = $_GET['id'];

    $get_img = "SELECT * FROM upti_announce WHERE id = '$id'";
    $get_img_qry = mysqli_query($connect, $get_img);
    $get_fetch = mysqli_fetch_array($get_img_qry);

    $old_img = $get_fetch['announce_img'];
    // echo '<br>';
    if (isset($_POST['announcementedit'])) {

        $date = date('m-d-Y');

        $status = $_POST['status'];
        $img = $_FILES['cfile']['name'];

        $img_size = $_FILES['cfile']['size'];
        $img_tmp = $_FILES['cfile']['tmp_name'];
        
        $img_ex = pathinfo($img, PATHINFO_EXTENSION);

        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png");

        $new_name = uniqid($date.'-', true).'.'.$img_ex_lc;
        $img_path_sa_buhay_niya = '../images/slide/'.$new_name;
        move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

        if ($img == '') {
            $new_name = $old_img;
        }

        $epayment_process = "UPDATE upti_announce SET announce_img = '$new_name', announce_status = '$status' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../ma-announcement.php';</script>";

    }

?>