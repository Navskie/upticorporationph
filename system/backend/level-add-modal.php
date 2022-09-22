<?php
    if (isset($_POST['level'])) {

        $lvl = $_POST['lvl'];
        $per = $_POST['per'];
        $today = date('m-d-Y');

        $epayment_process = "INSERT INTO upti_level (levels, percent, date_now, level_status) VALUES ('$lvl', '$per', '$today', 'Active')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
        echo "<script>alert('Data has been Added successfully.');window.location.href = 'level2203.php';</script>";

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Reseller Level Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="level2203.php" method="post">
            <div class="row">
                <div class="col-6">
                    <label for="">Level</label>
                    <input type="text" class="form-control" name="lvl" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Percentage</label>
                    <input type="text" class="form-control" name="per" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="level">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>