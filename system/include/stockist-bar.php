<?php  $images = $get_info_fetch['users_img']; 
    $role = $_SESSION['role'];
    if ($role == 'UPTIRESELLER') {
?>
<aside class="main-sidebar sidebar-light-primary" style="background: #b0e0e6 !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTI STOCKIST</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3">
         
        <div class="image">
          <span class="badge badge-danger position-absolute py-2 mt-1 ml-1">Level <?php echo $get_info_fetch['users_level'] ?></span>
          <?php if ($images != '') { ?>
          <img src="./images/profile/<?php echo $images ?>" class="rounded-circle" style="width: 90%; z-index: -5;">
          <?php } else { ?>
          <img src="./images/profile/default.png" class="rounded-circle" style="width: 90%; z-index: -5;">
          <?php } ?>
        </div>       
      </div>
        <p class="text-center text-dark"><?php echo $get_info_fetch['users_name'] ?></p>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- <li class="nav-item">
            <a href="reseller.php" class="nav-link">
                <i class="nav-icon fas fa-reply"></i>
              <p>
                Back to Reseller
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="stockist.php" class="nav-link">
              <i class="nav-icon uil uil-building"></i>
              <p>
                My Inventory
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-file"></i>
              <p>
                Purchase Order
                <i class="uil uil-arrows-shrink-v right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-po.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request Purchase Order</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-po-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Order List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            $code_reseller = $_SESSION['code'];

            $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$code_reseller'";
            $check_stockist_qry = mysqli_query($connect, $check_stockist);
            $check_stockist_fetch = mysqli_fetch_array($check_stockist_qry);
            $check_stockist_num = mysqli_num_rows($check_stockist_qry);

            $country = $check_stockist_fetch['stockist_country'];
            $state = $check_stockist_fetch['stockist_state'];

            if ($country == 'Canada' || $country == 'CANADA') {
              if ($state != 'ALBERTA') {
                $state == 'ALBERTA';

                $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state != '$state' OR trans_country = '$country' AND trans_status = 'Pending' AND trans_state = ' '";
                $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
                $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
              } else {
                $state == 'ALBERTA';

                $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state = '$state'";
                $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
                $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
              }
            } else {
              $state == 'ALL';

              $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state = '$state'";
              $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
              $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
            }
          ?>
          <li class="nav-item">
            <a href="incoming-pending-order.php" class="nav-link">
              <i class="uil uil-shopping-bag nav-icon"></i>
              <p>
                Incoming Orders
                <span class="badge badge-danger right"><?php echo $get_sum_data_fetch['bilang']; ?></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="uil uil-list-ol nav-icon"></i>
              <p>
                Order List
                <i class="uil uil-arrows-shrink-v right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="incoming-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Processed Orders</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-delivered.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-cancel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancelled Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- EXCLUSIVE -->
          <?php
            $get_sum_data = "SELECT COUNT(*) AS bilang FROM web_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state = '$state'";
            $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
            $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);

            $get_sum_data = "SELECT * FROM stockist WHERE stockist_code = '$code_reseller'";
            $get_sum_data_qry = mysqli_query($connect, $check_stockist);
            $get_sum_data_fetch = mysqli_fetch_array($check_stockist_qry);
            $check_stockist_num = mysqli_num_rows($check_stockist_qry);

            $country = $check_stockist_fetch['stockist_country'];
            $state = $check_stockist_fetch['stockist_state'];

            if ($country == 'Canada' || $country == 'CANADA') {
              if ($state != 'ALBERTA') {
                $state == 'ALBERTA';

                $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state != '$state' OR trans_country = '$country' AND trans_status = 'Pending' AND trans_state = ' '";
                $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
                $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
              } else {
                $state == 'ALBERTA';

                $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state = '$state'";
                $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
                $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
              }
            } else {
              $state == 'ALL';

              $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_state = '$state'";
              $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
              $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
            }
          ?>
          <li class="nav-item">
            <a href="cs-pending-order.php" class="nav-link">
              <i class="uil uil-globe nav-icon"></i>
              <p>
                Customer Orders
                <span class="badge badge-info right"><?php echo $get_sum_data_fetch['bilang']; ?></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="uil uil-list-ol nav-icon"></i>
              <p>
                Website Order List
                <i class="uil uil-arrows-shrink-v right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="website-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Processed Orders</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="website-delivered.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="website-cancel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancelled Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            if ($check_stockist_num > 0) {
              $country = $check_stockist_fetch['stockist_country'];
              $get_sum_data = "SELECT COUNT(*) AS bilang FROM upti_transaction WHERE trans_country = '$country' AND trans_status = 'RTS' AND trans_stockist = 'Not Received' AND trans_state = '$state'";
              $get_sum_data_qry = mysqli_query($connect, $get_sum_data);
              $get_sum_data_fetch = mysqli_fetch_array($get_sum_data_qry);
          ?>
          <li class="nav-item">
            <a href="incoming-rts-order.php" class="nav-link">
              <i class="uil uil-corner-up-left-alt nav-icon"></i>
              <p>
                RTS Orders
                <span class="badge badge-danger right"><?php echo $get_sum_data_fetch['bilang']; ?></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="incoming-generate-order.php" class="nav-link">
              <i class="uil uil-corner-up-left-alt nav-icon"></i>
              <p>
                Generate Reports
              </p>
            </a>
          </li>
          <?php
            }
            
            if ($_SESSION['uid'] == '1010') {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="uil uil-wallet nav-icon"></i>
              <p>
                Stockist Wallet
                <i class="uil uil-arrows-shrink-v right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-wallet.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Balance</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-refund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Refund</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-percentage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Percentage</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stockist-withdraw.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Withdrawal</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- END -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php } elseif ($role == 'WEBSITE') { ?>
  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary" style="background: #b0e0e6 !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTIMISED PH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: #b0e0e6 !important;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./images/icon/274966106_640652090373107_513539919171817442_n.ico" class="" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $get_info_fetch['users_name'] ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Incoming Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cs-pendings-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
            </ul> -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cs-onprocess-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Process Orders</p>
                </a>
              </li>
            </ul>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cs-intransit-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Orders</p>
                </a>
              </li>
            </ul> -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cs-delivered-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cs-rts-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RTS Orders</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php } else { ?>
  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary" style="background: #b0e0e6 !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTIMISED PH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: #b0e0e6 !important;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./images/icon/274966106_640652090373107_513539919171817442_n.ico" class="" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $get_info_fetch['users_name'] ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Wallet Request
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="accounting.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request List</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-wallet-list3.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawal History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="stockist-orders.php" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Stockist Orders
                <?php
                  $count_sql = "SELECT COUNT(id) AS tots FROM stockist_request WHERE req_status = 'Pending'";
                  $count_qry = mysqli_query($connect, $count_sql);
                  $count_fetch = mysqli_fetch_array($count_qry);

                  if ($count_fetch['tots'] > 0) {
                ?>
                <span class="badge badge-warning right"><?php echo $count_fetch['tots'] ?></span>
                <?php
                  }
                ?>
                
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php } ?>