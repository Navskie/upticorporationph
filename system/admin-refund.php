<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- START HERE -->
    <section class="content">
        <div class="container-fluid">
          <!-- Generate Sales -->
            <div class="row">
              <!-- Code Quantity -->
              <div class="col-3">
                <div class="card rounded-0">
                  <div class="card-body">
                    <div class="form-group">
                      <img src="images/codes.jpg" alt="" class="img-responsive w-100">
                    </div>
                    <h5 class="text-center pb-2">
                      Code Quantity Reports
                    </h5>
                    <form action="code-qty-excel.php" method="post">


                      <div class="row">
                        <div class="col-6">
                          <label for="">Date From</label>
                          <div class="form-group">
                            <input type="date" name="date1" id="" class="form-control">
                          </div>
                        </div>


                        <div class="col-6">
                          <label for="">Date From</label>
                          <div class="form-group">
                            <input type="date" name="date2" id="" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Item Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="item_code">
                          <option value="">Choose</option>
                          <?php
                              $product_sql = "SELECT items_code, items_desc FROM upti_items WHERE items_status = 'Active' UNION SELECT package_code, package_desc FROM upti_package WHERE package_status = 'Active'";
                              $product_qry = mysqli_query($connect, $product_sql);
                              while ($product = mysqli_fetch_array($product_qry)) {
                          ?>
                          <option value="<?php echo $product['items_code'] ?>">[ <?php echo $product['items_code'] ?> ] → <?php echo $product['items_desc'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <button class="btn btn-dark form-control rounded-0" name="CQR"><i class="uil uil-download-alt"></i> Code Quantity Reports</button>
                    </form>
                  </div><!-- CARD BODY End -->
                </div><!-- CARD End -->
              </div><!-- COL-3 End -->
              <!-- Code Quantity End -->

              <!-- Sold Quantity -->
              <div class="col-3">
                <div class="card rounded-0">
                  <div class="card-body">
                    <div class="form-group">
                      <img src="images/sold.jpg" alt="" class="img-responsive w-100">
                    </div>
                    <h5 class="text-center pb-2">
                      Sold Quantity Reports
                    </h5>
                    <form action="sold-qty-excel.php" method="post">


                      <div class="row">
                        <div class="col-6">
                          <label for="">Date From</label>
                          <div class="form-group">
                            <input type="date" name="date1" id="" class="form-control">
                          </div>
                        </div>


                        <div class="col-6">
                          <label for="">Date From</label>
                          <div class="form-group">
                            <input type="date" name="date2" id="" class="form-control">
                          </div>
                        </div>


                        <div class="col-6">
                          <div class="form-group">
                            <label>Country</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="country">
                              <option value="">Choose</option>
                              <?php
                                  $product_sql = "SELECT cc_country FROM upti_country_currency";
                                  $product_qry = mysqli_query($connect, $product_sql);
                                  while ($product = mysqli_fetch_array($product_qry)) {
                              ?>
                              <option value="<?php echo $product['cc_country'] ?>"><?php echo $product['cc_country'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        
                        <div class="col-6">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="status">
                              <option value="">Choose</option>
                              <option value="Pending">Pending</option>
                              <option value="On Process">On Process</option>
                              <option value="In Transit">In Transit</option>
                              <option value="Order Delivered">Delivered</option>
                              <option value="RTS">RTS</option>
                            </select>
                          </div>
                        </div>


                      </div>
                      <button class="btn btn-dark form-control rounded-0" name="SQR"><i class="uil uil-download-alt"></i> Sold Quantity Reports</button>
                    </form>
                  </div><!-- CARD BODY End -->
                </div><!-- CARD End -->
              </div><!-- COL-3 End -->
              <!-- Sold Quantity End -->

              
            </div><!-- ROW End -->
        </section>
  </div>

<?php include 'include/footer.php'; ?>