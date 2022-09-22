<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_SESSION['uid'];
    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;

    $profile = $_SESSION['code'];

    if (isset($_POST['pay'])) {

        $img_name = $_FILES['file']['name'];
        $img_size = $_FILES['file']['size'];
        $img_tmp = $_FILES['file']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png", "gif", "webp");

        if (in_array($img_ex_lc, $allow_ex)) {
            $new_name = $ref.random_int(10, 99).'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = '../assets/images/payment/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

            // echo $new_name;

            $upload_stmt = mysqli_query($connect, "INSERT INTO web_payment (
                payment_uid,
                payment_ref,
                payment_img
            ) VALUES (  
                '$profile',
                '$ref',
                '$new_name'
            )");

            flash("success", "Image has been uploaded successfully");
            header('location: ../cart.php');
        }
        
    }
?>
