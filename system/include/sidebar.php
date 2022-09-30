<style>
    .siderbar {
        background: #b0e0e6 !important;
    }
</style>
<?php
  // session_start();
 
  $images = $get_info_fetch['users_img'];

  if ($_SESSION['role'] == 'UPTIMAIN') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary"> 
    <!-- Brand Logo -->
    <a href="#" class="brand-link"> 
      <img src="images/navbar.png" class="brand-image img-circle">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="uptimain.php" class="nav-link">
            <i class="nav-icon uil uil-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="osr-sales.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                OSR EOD
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="s_ph.php" class="nav-link">
              <i class="nav-icon uil uil-globe"></i>
              <p>
                Stocks
              </p>
            </a>
          </li>
          <li class="nav-header">Manage Accounts</li>
          <li class="nav-item"> 
            <a href="stock-branch.php" class="nav-link">
              <i class="nav-icon uil uil-building"></i>
              <p>
                Stockist Branch 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-branch.php" class="nav-link">
              <i class="nav-icon uil uil-user-check"></i>
              <p>
                CSR Branch
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="main-employee.php" class="nav-link">
              <i class="nav-icon uil uil-users-alt"></i>
              <p>
                Employee
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-list.php" class="nav-link">
              <i class="nav-icon uil uil-house-user"></i>
              <p>
                Reseller
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-main-list.php" class="nav-link">
              <i class="nav-icon uil uil-user-arrows"></i>
              <p>
                Main Reseller
              </p>
            </a>
          </li>

          <li class="nav-header">Products</li>
          <li class="nav-item">
            <a href="warehouse.php" class="nav-link">
              <i class="nav-icon uil uil-university"></i>
              <p>
                Warehouse
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="critical-ph.php" class="nav-link">
              <i class="nav-icon uil uil-exclamation-triangle"></i>
              <p>
                Stocks Critical Level
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="purchase-order.php" class="nav-link">
              <i class="nav-icon uil uil-file-landscape"></i>
              <p>
                Supplier Purchase Order
              </p> 
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="stockist-requestpo.php" class="nav-link">
              <i class="nav-icon fas fa-reply"></i>
              <p>
                Stockist Purchase Order
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="ph-po.php" class="nav-link">
              <i class="nav-icon uil uil-file-graph"></i>
              <p>
                PH Purchase Order
              </p>
            </a>
          </li>

          <li class="nav-header">Customer Order</li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
              <i class="nav-icon uil uil-search-alt"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-shopping-cart-alt"></i>
              <p>
                Manage Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-all-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-pending-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-in-transit-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-on-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Process</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-cancel-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-delivered-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-rts-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RTS Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-code-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Code Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sold-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sold Quantity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sales-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-osr-report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-refund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Refund</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Order Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-shipping.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-cash.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-epayment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-bank.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Payment</p>
                </a>
              </li>
            </ul>
          </li> -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-wallet"></i>
              <p>
                EWallet Request
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-wallet-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-Wallet Request List</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-wallet-list2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawal History</p>
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
<?php
  } elseif ($_SESSION['role'] == 'UPTIMAINS') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary"> 
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="images/navbar.png" class="brand-image img-circle">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="uptimain.php" class="nav-link">
            <i class="nav-icon uil uil-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="s_ph.php" class="nav-link">
              <i class="nav-icon uil uil-globe"></i>
              <p>
                Stocks
              </p>
            </a>
          </li>
          <li class="nav-header">Manage Accounts</li>
          <li class="nav-item"> 
            <a href="stock-branch.php" class="nav-link">
              <i class="nav-icon uil uil-building"></i>
              <p>
                Stockist Branch 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-branch.php" class="nav-link">
              <i class="nav-icon uil uil-user-check"></i>
              <p>
                CSR Branch
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="main-employee.php" class="nav-link">
              <i class="nav-icon uil uil-users-alt"></i>
              <p>
                Employee
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-list.php" class="nav-link">
              <i class="nav-icon uil uil-house-user"></i>
              <p>
                Reseller
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-main-list.php" class="nav-link">
              <i class="nav-icon uil uil-user-arrows"></i>
              <p>
                Main Reseller
              </p>
            </a>
          </li>

          <!-- <li class="nav-header">Products</li>
          <li class="nav-item">
            <a href="warehouse.php" class="nav-link">
              <i class="nav-icon uil uil-university"></i>
              <p>
                Warehouse
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="critical-ph.php" class="nav-link">
              <i class="nav-icon uil uil-exclamation-triangle"></i>
              <p>
                Stocks Critical Level
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="purchase-order.php" class="nav-link">
              <i class="nav-icon uil uil-file-landscape"></i>
              <p>
                Supplier Purchase Order
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="stockist-requestpo.php" class="nav-link">
              <i class="nav-icon fas fa-reply"></i>
              <p>
                Stockist Purchase Order
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="ph-po.php" class="nav-link">
              <i class="nav-icon uil uil-file-graph"></i>
              <p>
                PH Purchase Order
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-list-ol"></i>
              <p>
                Manage Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="item-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Single Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-package.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bundle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-code.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item Code</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-country.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-country-currency.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Customer Order</li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
            <i class="nav-icon uil uil-search-alt"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Manage Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-all-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-pending-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-in-transit-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-on-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Process</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-cancel-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-delivered-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-rts-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RTS Orders</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-code-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Code Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sold-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sold Quantity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sales-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-osr-report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-refund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Refund</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-sliders-v-alt"></i>
              <p>
                Order Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-shipping.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shipping Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-cash.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-epayment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-bank.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Payment</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                EWallet Request
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-wallet-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-Wallet Request List</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-wallet-list2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawal History</p>
                </a>
              </li>
            </ul>
          </li>           -->
          <li class="nav-item">
            <a href="ma-announcement.php" class="nav-link">
              <i class="nav-icon uil uil-trophy"></i>
              <p>
                Top Banner
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="accounting-inventory.php" class="nav-link">
              <i class="nav-icon uil uil-building"></i>
              <p>
                Inventory
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($_SESSION['role'] == 'UPTIHR') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary"> 
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="images/navbar.png" class="brand-image img-circle">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="uptimain.php" class="nav-link">
            <i class="nav-icon uil uil-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="s_ph.php" class="nav-link">
              <i class="nav-icon uil uil-globe"></i>
              <p>
                Stocks
              </p>
            </a>
          </li>
          <li class="nav-header">Manage OSR</li>
          <li class="nav-item"> 
            <a href="Osrlist.php" class="nav-link">
              <i class="nav-icon uil uil-user-check"></i>
              <p>
                OSR Account 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="osr-reports2.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate OSR Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-osr-report.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                OSR Sales Ranking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-reseller.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Reseller Sales Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-sales-item.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Sales Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="hr-export.php" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Export Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="accounting-inventory.php" class="nav-link">
              <i class="nav-icon uil uil-chart"></i>
              <p>Inventory</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
              <i class="nav-icon uil uil-search-alt"></i>
              <p>
                Search
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
  } elseif ($_SESSION['role'] == 'IT/Sr Programmer') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="navskie.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">System Activities</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Activities
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="activities.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Activity List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Manage Accounts</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Accounts
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="IT-account-list2022.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Products</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Manage Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="item-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-package.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-code.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item Code</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-country.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="item-country-currency.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Customer Order</li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-code-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Code Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sold-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sold Quantity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sales-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">System Setting</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Earnings Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="225290563.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upgrade Reseller</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-level-up-alt"></i>
              <p>
                Reseller Level
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="level2203.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Level</p>
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
<?php
  } elseif ($_SESSION['role'] == 'UPTIRESELLER') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTIMISED PH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: #b0e0e6 !important;">
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
      <p class="text-center"><?php echo $get_info_fetch['users_name'] ?></p>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="reseller.php" class="nav-link">
              <i class="nav-icon uil uil-apps"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ticket.php" class="nav-link">
              <i class="nav-icon uil uil-ticket"></i>
              <p>
                Ticket
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="s_ph.php" class="nav-link">
              <i class="nav-icon uil uil-globe"></i>
              <p>
                Stocks
              </p>
            </a>
          </li> -->
          <!-- EXCLUSIVE -->
          <?php
            $code_reseller = $_SESSION['code'];

            $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$code_reseller'";
            $check_stockist_qry = mysqli_query($connect, $check_stockist);
            $check_stockist_fetch = mysqli_fetch_array($check_stockist_qry);
            $check_stockist_num = mysqli_num_rows($check_stockist_qry);

            if ($check_stockist_num > 0) {
          ?>
          <li class="nav-item">
            <a href="stockist.php" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Stockist Page
              </p>
            </a>
          </li>
          
          <?php } else { ?>
          <!-- END -->
          <li class="nav-header">Sales</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-shopping-bag"></i>
              <p>
                Customer Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Order</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reorder.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Re-Order</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="my-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personal Sales</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="down-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-setting"></i>
              <p>
                Sales Status
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-pending.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-on-process.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Process Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-on-transit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-delivered.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-rts.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RTS Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order-cancel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reseller-sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="osr-reports2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-wallet"></i>
              <p>
                Earning Wallet
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="wallet-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-Wallet</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="wallet-request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-Wallet Request</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Accounts</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-user-plus"></i>
              <p>
                Create Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="osr-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="account-manager.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="account-leader.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Leader</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="account-OSR.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
        <?php } ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
  } elseif ($_SESSION['role'] == 'UPTIMANAGER') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
          <h6 class="text-light"><?php echo $get_info_fetch['users_role'] ?></h6>
        </div>
      </div>
    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="manager.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Account List</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manager-tl.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Leader</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manager-osr.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Generate Report</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Manager Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manager-sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Sales Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Setting</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
  } elseif ($_SESSION['role'] == 'UPTILEADER') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
          <h6 class="text-light"><?php echo $get_info_fetch['users_role'] ?></h6>
        </div>
      </div>
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="manager.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Account List</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="leader-osr.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Generate Report</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                OSR Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="leader-sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Report</p>
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
<?php
  } elseif ($_SESSION['role'] == 'UPTIOSR') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTIMISED PH<?php $creator_code = $_SESSION['code']; ?></span>
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="osr.php" class="nav-link">
              <i class="nav-icon uil uil-create-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="osr-fb.php" class="nav-link">
              <i class="nav-icon uil uil-facebook-f"></i>
              <p>
                Facebook Page
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="osr-wallet.php" class="nav-link">
              <i class="nav-icon uil uil-wallet"></i>
              <p>
                Wallet
              </p>
            </a>
          </li>
          <li class="nav-header">Customer Orders</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-shopping-bag"></i>
              <p>
                Manage Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reorder.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Re-Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="my-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Transaction</p>
                </a>
              </li>
              <li class="nav-item"> 
                <a href="osr-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Reseller</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="my-reseller.php" class="nav-link">
              <i class="nav-icon uil uil-users-alt"></i>
              <p>
                My Reseller
              </p>
            </a>
          </li>
          <li class="nav-header">Manage Reports</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate Sales Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="osr-reports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales & Points Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="osr-reseller-sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="tiktok-osr.php" class="nav-link">
              <i class="nav-icon uil uil-ticket"></i>
              <p>
                Tiktok Entry
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="s_ph.php" class="nav-link">
              <i class="nav-icon uil uil-globe"></i>
              <p>
                Stocks
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($_SESSION['role'] == 'UPTICSR') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="uptikier.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Customer Order</li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Manage Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-all-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-pending-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-in-transit-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-on-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Process</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-cancel-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-delivered-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                Order Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-country-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Report</p>
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
  <?php
  } elseif ($_SESSION['role'] == 'BRANCH') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="branch.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Customer Order</li>
          <li class="nav-item">
            <a href="search04292022.php" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Manage Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="branch-all-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch-on-process-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>On Process Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch-in-transit-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Transit Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch-cancel-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch-delivered-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivered Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branch-rts-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RTS Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            $csrid = $_SESSION['uid'];

            $csr_country = "SELECT * FROM upti_users WHERE users_id = '$csrid'";
            $csr_country_qry = mysqli_query($connect, $csr_country);
            $csr_country_fetch = mysqli_fetch_array($csr_country_qry);

            $country = $csr_country_fetch['users_employee'];

            if ($country == 'TAIWAN' || $country == 'JAPAN' || $country == 'UNITED ARAB EMIRATES' || $country == 'KOREA') {

          ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  My Country
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="csr/taiwan.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>TAIWAN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/japan.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>JAPAN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/dubai.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DUBAI</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/korea.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>KOREA</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } elseif ($country == 'SINGAPORE' || $country == 'HONGKONG' || $country == 'MACAU') { ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  My Country
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="csr/singapore.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SINGAPORE</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/hongkong.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>HONGKONG</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/macau.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>MACAU</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } elseif ($country == 'CANADA' || $country == 'PHILIPPINES') { ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  My Country
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="csr/canada.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>CANADA</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="csr/philippines.php?country=<?php echo $csrid ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PHILIPPINES</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($_SESSION['role'] == 'UPTICREATIVES') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Manage Creatives</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ma-announcement.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Announcement</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-country-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Single Item</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-reseller-order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package Item</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($_SESSION['role'] == 'SPECIAL') {
?>
    <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="showproduct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reseller-tree.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Tree</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="admin-reseller.php" class="nav-link">
              <i class="nav-icon uil uil-dollar-alt"></i>
              <p>
                Reseller Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="showproduct.php" class="nav-link">
              <i class="nav-icon uil uil-pricetag-alt"></i>
              <p>
                PH Prices
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-tree.php" class="nav-link">
              <i class="nav-icon uil uil-cloud-database-tree"></i>
              <p>
                Reseller Tree
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="search04062022.php" class="nav-link">
              <i class="nav-icon uil uil-search"></i>
              <p>
                Search Poid
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-list.php" class="nav-link">
              <i class="nav-icon uil uil-users-alt"></i>
              <p>
                Reseller
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reseller-count.php" class="nav-link">
              <i class="nav-icon uil uil-user-plus"></i>
              <p>
                Reseller Count
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-sold-item.php" class="nav-link">
              <i class="nav-icon uil uil-percentage"></i>
              <p>
                Sold Quantity
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tiktok.php" class="nav-link">
              <i class="nav-icon uil uil-ticket"></i>
              <p>
                Tiktok Entry
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin-info.php" class="nav-link">
              <i class="nav-icon uil uil-dollar-alt"></i>
              <p>
                Reseller Information
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <?php
  } elseif ($_SESSION['role'] == 'UPTIACCOUNTING') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
            <a href="accounting.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="osc-wallet-list.php" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>Add Token</p>
            </a>
          </li>
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
                <a href="accounting-request.php" class="nav-link">
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
            <a href="accounting-po.php" class="nav-link">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>Purchase Orders</p>
            </a>
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
          <li class="nav-item">
            <a href="accounting-inventory.php" class="nav-link">
              <i class="nav-icon uil uil-chart"></i>
              <p>Inventory</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon uil uil-panel-add"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-code-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Code Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sold-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sold Quantity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-sales-item.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-reseller.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reseller Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-osr-report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSR Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin-refund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stockist Refund</p>
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
  <?php
  } elseif ($_SESSION['role'] == 'ADS') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/UPTi.png" class="brand-image img-circle">
      <span class="brand-text font-weight-700">UPTIMISED PH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: #b0e0e6 !important;">
    <br>
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="fb-page.php" class="nav-link">
            <i class="nav-icon uil uil-browser"></i>
            <p>FB Page</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="ads.php" class="nav-link">
            <i class="nav-icon uil uil-tag-alt"></i>
            <p>EOD</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon uil uil-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($role == 'LOGISTIC') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="logistic-supplier.php" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>Supplier PO</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="warehouse-ph.php" class="nav-link">
          <i class="nav-icon fas fa-warehouse"></i>
          <p>My Inventory</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="logistic.php" class="nav-link">
          <i class="nav-icon fas fa-reply"></i>
          <p>Incoming PO</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="warehouse-ph-main.php" class="nav-link">
          <i class="nav-icon fas fa-reply"></i>
          <p>PH Incoming PO</p>
        </a>
      </li>
      <!-- warehouse-ph-main -->
      <li class="nav-item">
        <a href="logistic-po.php" class="nav-link">
          <i class="nav-icon fas fa-list-ol"></i>
          <p>Purchased Order List</p> 
        </a>
      </li>
      <li class="nav-item">
        <a href="ph-rts.php" class="nav-link">
          <i class="nav-icon fas fa-reply"></i>
          <p>RTS</p> 
        </a>
      </li>
      <li class="nav-item">
        <a href="ph-rts-list.php" class="nav-link">
          <i class="nav-icon fas fa-list-ol"></i>
          <p>RTS List</p> 
        </a>
      </li>
    </ul>
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  } elseif ($role == 'DHL') {
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
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
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="dhl.php" class="nav-link">
          <i class="nav-icon fas fa-reply"></i>
          <p>Incoming PO</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="dhl-po.php" class="nav-link">
          <i class="nav-icon fas fa-list-ol"></i>
          <p>Purchased Order</p>
        </a>
      </li>
    </ul>
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
  }
?>