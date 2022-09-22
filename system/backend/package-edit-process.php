<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['package'])) {

        $pack_code = $_POST['pack_code'];
        $pack_desc = $_POST['pack_desc'];
        $pack_points = $_POST['pack_points'];
        $pack_c1 = $_POST['one_code'];
        $pack_qty1 = $_POST['one_qty'];
        $pack_c2 = $_POST['two_code'];
        $pack_qty2 = $_POST['two_qty'];
        $pack_c3 = $_POST['three_code'];
        $pack_qty3 = $_POST['three_qty'];
        $pack_c4 = $_POST['four_code'];
        $pack_qty4 = $_POST['four_qty'];
        $pack_c5 = $_POST['five_code'];
        $pack_qty5 = $_POST['five_qty'];
        $stats = $_POST['stats'];
        $exc = $_POST['exc'];

        $check_pack = "SELECT * FROM upti_package WHERE id = '$id'";
        $check_pack_qry = mysqli_query($connect, $check_pack);
        $pack_fetch = mysqli_fetch_array($check_pack_qry);

        $old_code = $pack_fetch['package_code'];

        if ($pack_code == $old_code) {
            if ($pack_code == '') {
                echo "<script>alert('Package Code is missing.');window.location.href = '../item-package.php';</script>";
            } else {
                $packages = "UPDATE upti_package SET package_exclusive = '$exc', package_status = '$stats', package_code = '$pack_code', package_desc = '$pack_desc', package_points = '$pack_points', package_one_code = '$pack_c1', package_one_qty = '$pack_qty1', package_two_code = '$pack_c2', package_two_qty = '$pack_qty2', package_three_code = '$pack_c3', package_three_qty = '$pack_qty3', package_four_code = '$pack_c4', package_four_qty = '$pack_qty4', package_five_code = '$pack_c5', package_five_qty = '$pack_qty5' WHERE id = '$id'";
                $package_qry = mysqli_query($connect, $packages);

                echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-package.php';</script>";
            }
        } else {
            $get_package_sql = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
            $get_package_qry = mysqli_query($connect, $get_package_sql);
            $get_num_code = mysqli_num_rows($get_package_qry);

            if ($get_num_code == 0) {
                if ($pack_code == '') {
                    echo "<script>alert('Package Code is missing.');window.location.href = 'item-package.php';</script>";
                } else {
                    $packages = "UPDATE upti_package SET package_exclusive = '$exc', package_status = '$stats', package_code = '$pack_code', package_desc = '$pack_desc', package_points = '$pack_points', package_one_code = '$pack_c1', package_one_qty = '$pack_qty1', package_two_code = '$pack_c2', package_two_qty = '$pack_qty2', package_three_code = '$pack_c3', package_three_qty = '$pack_qty3', package_four_code = '$pack_c4', package_four_qty = '$pack_qty4', package_five_code = '$pack_c5', package_five_qty = '$pack_qty5' WHERE id = '$id'";
                    $package_qry = mysqli_query($connect, $packages);

                    echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-package.php';</script>";
                }
            } else {
                echo "<script>alert('Duplicate Package code is not allowed.');window.location.href = '../item-package.php';</script>";
            }
        }

    }
?>