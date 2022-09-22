<?php
    include 'dbms/conn.php';

    session_start();

    $id = $_GET['id'];

    $get_poid = "SELECT * FROM stockist_remarks WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);

    $ref = $get_poid_fetch['remarks_reference'];
    $role = $_SESSION['role'];

    if ($role == 'UPTIACCOUNTING') {
        $update_remarks = "UPDATE stockist_remarks SET remarks_stockist = '' WHERE remarks_reference = '$ref'";
        $update_remarks_qry = mysqli_query($connect, $update_remarks);
    } else {
        $update_remarks = "UPDATE stockist_remarks SET remarks_csr = '' WHERE remarks_reference = '$ref'";
        $update_remarks_qry = mysqli_query($connect, $update_remarks);
    }

?>
<script>window.location.href = 'reference-info.php?poid=<?php echo $ref ?>';</script>
