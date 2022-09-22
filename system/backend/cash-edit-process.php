<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['cashupdate'])) {

        $country = $_POST['country'];
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $cashs_mop = $_FILES['cfile']['name'];
        $img_size = $_FILES['cfile']['size'];
        $img_tmp = $_FILES['cfile']['tmp_name'];

        $img_ex = pathinfo($cashs_mop, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png", "gif");

        if (in_array($img_ex_lc, $allow_ex)) {
            $new_name = uniqid("SS-", true).'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = '../images/payment/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

        $epayment_process = "UPDATE upti_mod SET mod_img = '$new_name', mod_country = '$country' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../order-cash.php';</script>";
        }
    }
?>