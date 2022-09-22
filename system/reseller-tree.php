<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reseller Tree</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

        
        <!-- START HERE -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body login-card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" class="form-control" name="date1" style="border-radius: 0 !important">
                            </div>
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" class="form-control" name="date2" style="border-radius: 0 !important">
                            </div>
                            <div class="form-group">
                                <!-- <br> -->
                                <button type="submit" name="tree" class="form-control btn btn-dark" style="border-radius: 0 !important">Search Reseller Tree </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body login-card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Reseller Name</label>
                                <input type="text" class="form-control" style="border-radius: 0 !important" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                
                                <button type="submit" name="tree" class="form-control btn btn-dark" style="border-radius: 0 !important">Search Details</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="row">
                    <?php
                        if(isset($_POST['tree'])) {
                            $newDate1 = $_POST['date1'];
                            $date1 = date("m-d-Y", strtotime($newDate1));
                            $newDate2 = $_POST['date2'];
                            $date2 = date("m-d-Y", strtotime($newDate2));

                            $get_nani = "SELECT * FROM upti_transaction";
                            $get_nani_qry = mysqli_query($connect, $get_nani);
                            $get_nani_num = mysqli_num_rows($get_nani_qry);
                        
                    ?>
                    <?php 
                        while($res_fetch = mysqli_fetch_array($get_nani_qry)) {
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <span>No found result.</span>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

<?php include 'include/footer.php'; ?>