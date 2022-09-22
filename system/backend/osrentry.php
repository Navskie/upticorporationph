<?php
    // session_start();

    include './dbms/conn.php';

    $codeko = $_SESSION['code'];

    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    if (isset($_POST['osrentry'])) {

      $poid = $_POST['ticket'];
      // $count = $_POST['count'];

      $get_information = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'");
      $get_fetch_info = mysqli_fetch_array($get_information);

      $ticket = $get_fetch_info['trans_seller'];
      $customer_name = $get_fetch_info['trans_fname'];
  
      $check_ticket = mysqli_query($connect, "SELECT COUNT(*) AS bilang FROM upti_raffle WHERE raffle_code = '$ticket'");
      $ticket_f = mysqli_fetch_array($check_ticket);
      if (mysqli_num_rows($check_ticket) > 0) {
        $new_count = $ticket_f['bilang'] + 1;
        $epayment_process = "INSERT INTO upti_raffle (raffle_time, raffle_date, raffle_code, raffle_number, raffle_poid, raffle_name) VALUES ('$time','$date','$ticket','$new_count', '$poid', '$customer_name')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
      } else {
        $epayment_process = "INSERT INTO upti_raffle (raffle_time, raffle_date, raffle_code, raffle_number, raffle_poid, raffle_name) VALUES ('$time','$date','$ticket','1', '$poid', '$customer_name')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
      }

      echo "<script>alert('Entry has been Added successfully.');window.location.href = 'tiktok-osr.php';</script>";

    }
?>
<div class="modal fade" id="oscentry">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Register Ticket</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="tiktok-osr.php" method="post">
            <div class="row">
                <div class="col-12">
                  <label>Choose Customer</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="ticket">
                      <option value="">Choose Customer</option>
                      <?php
                      $category_sql = "SELECT * FROM upti_transaction WHERE trans_seller = '$codeko' ORDER BY trans_date DESC";
                      $category_qry = mysqli_query($connect, $category_sql);
                      while ($category = mysqli_fetch_array($category_qry)) {
                      ?>
                      <option value="<?php echo $category['trans_poid'] ?>"><?php echo $category['trans_fname'] ?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="osrentry">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>