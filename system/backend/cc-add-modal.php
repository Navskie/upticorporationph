<?php
    include './dbms/conn.php';

    if (isset($_POST['bansa'])) {

        $country = $_POST['country'];
    
        $epayment_process = "INSERT INTO upti_country_currency (cc_country) VALUES ('$country')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Added successfully.');window.location.href = 'item-country-currency.php';</script>";
    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Country</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="item-country-currency.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Country</label>
                    <input type="text" class="form-control" name="country" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="bansa">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>