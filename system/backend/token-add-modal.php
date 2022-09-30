<?php
    $role = $_SESSION['role'];

    if (isset($_POST['fb'])) {

      $remarks = $_POST['remarks'];
      $amount = $_POST['amount'];
      $osc = $_POST['osc'];

      date_default_timezone_set("Asia/Manila"); 
      $date = date('m-d-Y');
      $time = date('h:i A');

      $epayment_process = "INSERT INTO upti_osc_history (
          h_date, 
          h_time, 
          h_code,
          h_credit,
          h_debit,
          h_remarks
        ) VALUES (
          '$date', 
          '$time', 
          '$osc', 
          '',
          '$amount',
          '$remarks'
        )";
      $epayment_process_qry = mysqli_query($connect, $epayment_process);

      $check_wallet = mysqli_query($connect, "SELECT * FROM upti_osc_wallet WHERE osc_code = '$osc'");
      $check_wallet_f = mysqli_fetch_array($check_wallet);
      if (mysqli_num_rows($check_wallet) > 0) {
        $new_wallet = $check_wallet_f['osc_wallet'] + $amount;
        $osc_add_wallet = mysqli_query($connect, "UPDATE upti_osc_wallet SET osc_wallet = '$new_wallet' WHERE osc_code = '$osc'");
      } else {
        $osc_add_wallet = mysqli_query($connect, "INSERT INTO upti_osc_wallet (osc_wallet, osc_code) VALUES ('$amount', '$osc')");
      }

      echo "<script>alert('Wallet has been submitted successfully.');window.location.href = 'osc-wallet-list.php';</script>";
    
    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Page Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <form action="osc-wallet-list.php" method="post">
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Remarks</label>
                      <input type="text" class="form-control" name="remarks" autocomplete="off" required>
                  </div>
              </div>
              <div class="col-12">
                  <div class="form-group">
                      <label>Amount</label>
                      <input type="text" class="form-control" name="amount" autocomplete="off" required>
                  </div>
              </div>
              <div class="col-12">
                  <div class="form-group">
                      <label>OSR List</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="osc">
                        <option value="">Select OSC</option>
                        <?php
                        $category_sql = "SELECT * FROM upti_users WHERE 
                        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_position = 'CHRIS' OR
                        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_position = 'ELLAN'
                        ";
                        $category_qry = mysqli_query($connect, $category_sql);
                        while ($category = mysqli_fetch_array($category_qry)) {
                        ?>
                        <option value="<?php echo $category['users_code'] ?>"><?php echo $category['users_name'] ?></option>
                        <?php } ?>
                      </select>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="fb">Submit</button>
        </form>
        </div>   
    </div>
    </div>
</div>