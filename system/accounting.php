<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">OSR Dashboard</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manager List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> 
                    <!-- Inquiries -->

        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                <div class="inner">
                    <?php

                        $get_total_wallet = mysqli_query($connect, "SELECT COUNT(id) AS wallet FROM upti_withdraw WHERE withdraw_status = 'Approve'");
                        $get_total_wallet_fetch = mysqli_fetch_array($get_total_wallet);
                        $wallet = $get_total_wallet_fetch['wallet'];

                    ?>
                    <h3>
                        <?php 
                            
                            if ($wallet == 0) {
                                echo '0';
                            } else {
                                echo number_format($wallet);
                            } 
                        ?>
                    </h3>

                    <p>Total Approve Wallet Request</p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                <div class="inner">
                    <?php

                        $get_total_wallet = mysqli_query($connect, "SELECT COUNT(id) AS wallet FROM upti_withdraw WHERE withdraw_status = 'Pending'");
                        $get_total_wallet_fetch = mysqli_fetch_array($get_total_wallet);
                        $wallet = $get_total_wallet_fetch['wallet'];

                    ?>
                    <h3>
                        <?php 
                            
                            if ($wallet == 0) {
                                echo '0';
                            } else {
                                echo number_format($wallet);
                            } 
                        ?>
                    </h3>

                    <p>Total Pending Wallet Request</p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <?php

                        $get_total_wallet = mysqli_query($connect, "SELECT COUNT(id) AS wallet FROM upti_withdraw WHERE withdraw_status = 'Decline'");
                        $get_total_wallet_fetch = mysqli_fetch_array($get_total_wallet);
                        $wallet = $get_total_wallet_fetch['wallet'];

                    ?>
                    <h3>
                        <?php 
                            
                            if ($wallet == 0) {
                                echo '0';
                            } else {
                                echo number_format($wallet);
                            } 
                        ?>
                    </h3>

                    <p>Total Reject Wallet Request</p>
                </div>
                <div class="icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                
                </div>
            </div>
                      
        </div>

        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    

  </div>

<?php include 'include/footer.php'; ?>