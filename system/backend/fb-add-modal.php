<?php
    $role = $_SESSION['role'];

    if (isset($_POST['fb'])) {

      $page_name = $_POST['page_name'];
      if ($role == 'ADS') {
        $newassign = $_POST['newassign'];
        $oldassign = $_POST['oldassign'];
      } else {
        $newassign = $_SESSION['code'];
        $oldassign = '';
      }
      $status = $_POST['status'];

      date_default_timezone_set("Asia/Manila"); 
      $date = date('m-d-Y');
      $time = date('h:i A');

      $check_item = "SELECT * FROM upti_page WHERE page_name = '$page_name'";
      $check_item_qry = mysqli_query($connect, $check_item);
      $check_item_num = mysqli_num_rows($check_item_qry);

      if ($check_item_num == 0) {
          if ($newassign == '') {
              
              if ($role == 'ADS') {
                echo "<script>alert('New Assigned Missing');window.location.href = 'fb-page.php';</script>";
              } else {
                echo "<script>alert('New Assigned Missing');window.location.href = 'osr-fb.php';</script>";
              }
          } else {
              $epayment_process = "INSERT INTO upti_page (page_name, page_new, page_old, page_status, page_date, page_time) VALUES ('$page_name', '$newassign', '$oldassign', '$status', '$date', '$time')";
              $epayment_process_qry = mysqli_query($connect, $epayment_process);

              if ($role == 'ADS') {
                echo "<script>alert('Page has been Added successfully.');window.location.href = 'fb-page.php';</script>";
              } else {
                echo "<script>alert('Page has been Added successfully.');window.location.href = 'osr-fb.php';</script>";
              }
    
          }
      } else {
        if ($role == 'ADS') {
          echo "<script>alert('New Assigned Missing.');window.location.href = 'fb-page.php';</script>";
        } else {
          echo "<script>alert('New Assigned Missing.');window.location.href = 'osr-fb.php';</script>";
        }
      }

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
          <?php 
            if ($role == 'ADS') {
          ?>
            <form action="fb-page.php" method="post">
          <?php
            } else {
          ?>
            <form action="osr-fb.php" method="post">
          <?php
            }
          ?>
        
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Page Name</label>
                      <input type="text" class="form-control" name="page_name" autocomplete="off" required>
                  </div>
              </div>
              <?php if ($role == 'ADS') { ?>
              <div class="col-12">
                  <div class="form-group">
                      <label>New Assigned OSC</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="newassign">
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
              <div class="col-12">
                  <div class="form-group">
                      <label>Old Assigned OSC</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="oldassign">
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
              <?php } ?>
              <div class="col-12">
                  <div class="form-group">
                      <label>Status</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="status">
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Restrict">Restrict</option>
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