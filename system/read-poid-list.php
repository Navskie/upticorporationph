<?php
    include 'dbms/conn.php';

    session_start();

    $id = $_GET['id'];

    $get_poid = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);

    $poid = $get_poid_fetch['trans_poid'];

    $role = $_SESSION['role'];

    if ($role == 'UPTIMAIN' || $role == 'BRANCH') {
        $update_remarks = "UPDATE upti_remarks SET remark_csr = '' WHERE remark_poid = '$poid'";
        $update_remarks_qry = mysqli_query($connect, $update_remarks);
    } else {
        $update_remarks = "UPDATE upti_remarks SET remark_reseller = '' WHERE remark_poid = '$poid'";
        $update_remarks_qry = mysqli_query($connect, $update_remarks);
    }

?>
<script>window.location.href = 'poid-list.php?id=<?php echo $id ?>';</script>