<?php
    include './dbms/conn.php';

    if (isset($_POST['employee'])) {

        $fname = $_POST['fname'];
        $status = $_POST['status'];
        $position = $_POST['position'];
        $us = $_POST['us'];
        $pw = $_POST['pw'];
        
        if ($position == 'UPTICSR') {
            $role = 'CSR';
        } elseif ($position == 'UPTICREATIVES') {
            $role = 'Multimedia Artist';
        } elseif ($position == 'UPTIACCOUNTING') {
            $role = 'Accounting';
        } elseif ($position == 'ADS') {
            $role = 'ADS';
        } elseif ($position == 'LOGISTIC') {
            $role = 'LOGISTIC';
        } elseif ($position == 'DHL') {
            $role = 'DHL';
        } elseif ($position == 'WEBSITE') {
            $role = 'WEBSITE';
        }

        $check_fee = "SELECT * FROM upti_users WHERE users_username = '$us'";
        $check_fee_qry = mysqli_query($connect, $check_fee);
        $check_num_row = mysqli_num_rows($check_fee_qry);

        if ($check_num_row == 0) {
            $epayment_process = "INSERT INTO upti_users (users_name, users_position, users_status, users_username, users_password, users_employee, users_role, users_code, users_tl, users_manager, users_main, users_creator, users_admin, users_inviter) VALUES ('$fname', '$role', '$status', '$us', '$pw', 'EMPLOYEE', '$position', '$position', 'UPTIMAIN', 'UPTIMAIN', 'UPTIMAIN', 'UPTIMAIN', 'UPTIMAIN', 'UPTIMAIN')";
            $epayment_process_qry = mysqli_query($connect, $epayment_process);

            echo "<script>alert('Data has been Added successfully.');window.location.href = 'main-employee.php';</script>";
        } else {
            echo "<script>alert('Duplicate Username is not allowed');window.location.href = 'main-employee.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Employee Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="main-employee.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="fname" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Position</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="position">
                            <option selected="selected">Select Status</option>
                            <option value="UPTICSR">CSR</option>
                            <option value="UPTICREATIVES">Creative</option>
                            <option value="UPTIACCOUNTING">Accounting</option>
                            <option value="ADS">ADS</option>
                            <option value="LOGISTIC">LOGISTIC</option>
                            <option value="DHL">DHL</option>
                            <option value="WEBSITE">WEBSITE</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="status">
                            <option selected="selected">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="us" autocomplete="off" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="pw" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="employee">Submit</button>
        </form>
        </div>
    </div>
    </div>
</div>