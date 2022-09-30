<div class="modal fade" id="edit<?php echo $code['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Page Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/fb-edit-process.php?id=<?php echo $code['id']; ?>" method="post">
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Page Name</label>
                      <input type="text" class="form-control" name="page_name" autocomplete="off" required value="<?php echo $code['page_name']; ?>">
                  </div>
              </div>
              <div class="col-12">
                  <div class="form-group">
                      <label>New Assigned OSC</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="newassign">
                        <?php
                          $osr1 = $code['page_new'];

                          $osr_name1 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr1'");
                          $osr1_fetch = mysqli_fetch_array($osr_name1);

                          $osr1_name = $osr1_fetch['users_name'];
                        ?>
                        <option value="<?php echo $code['page_new']; ?>"><?php echo $osr1_name; ?></option>
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
                        <?php
                          $osr2 = $code['page_old'];

                          $osr_name2 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr2'");
                          $osr2_fetch = mysqli_fetch_array($osr_name2);

                          $osr2_name = $osr2_fetch['users_name'];
                        ?>
                        <option value="<?php echo $code['page_old']; ?>"><?php echo $osr2_name; ?></option>
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