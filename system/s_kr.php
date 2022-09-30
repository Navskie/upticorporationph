<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                        <span class="float-left text-primary"><b>KOREA STOCKS</b></span>

                        <a href="s_kr.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          KOREA
                        </a>
                        <a href="s_tw.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          TAIWAN
                        </a>
                        <a href="s_jp.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          JAPAN
                        </a>
                        <a href="s_cnd.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          CANADA
                        </a>
                        <a href="s_sg.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          SINGAPORE
                        </a>
                        <a href="s_hk.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          HONGKONG
                        </a>
                        <a href="s_uae.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          DUBAI
                        </a>
                        <a href="s_mc.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          MACAU
                        </a>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <!-- Order List Table Start -->
                            <table id="example22" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th colspan="2" class="text-center">Item Description</th>
                                    <th colspan="2" class="text-center">Stocks</th>
                                  </tr>
                                </thead>
                                <?php
                                  $code_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'KOREA' ORDER BY si_item_stock ASC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $crtitical = $code['si_item_stock'];
                                ?>
                                <tr>
                                  <td class="text-center" width="20"><?php echo $number; ?></td>
                                  <td class="text-center" width="20"><b><?php echo $code['si_item_code'] ?></b></td>
                                  <td class="text-center"><?php echo $code['si_item_desc'] ?></td> 
                                  <td class="text-center"><?php echo $code['si_item_stock'] ?></td>
                                </tr>
                                <?php
                                    $number++;
                                  }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'include/footer.php'; ?>