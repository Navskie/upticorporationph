<?php
    include '../dbms/conn.php';

    $podi = $_GET['id'];

    if (isset($_POST['uploadfile'])) {
        $img_name = $_FILES['file']['name'];
        $img_size = $_FILES['file']['size'];
        $img_tmp = $_FILES['file']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png", "gif");

        if (in_array($img_ex_lc, $allow_ex)) {
            $new_name = $podi.'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = '../images/stockist/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

            $uploadfile_sql = "UPDATE stockist_request SET req_img = '$new_name' WHERE req_reference = '$podi'";
            $uploadfile_qry = mysqli_query($connect, $uploadfile_sql);
        
            echo "<script>alert('Receipt has been uploaded successfully.');window.location.href = '../stockist-po-list.php';</script>";

        }
    }
?>