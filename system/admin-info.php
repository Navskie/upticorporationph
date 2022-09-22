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
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Information Generation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
    </div>
    <!-- /.content-header -->
    
    <!-- START HERE -->
    <section class="content">
        <div class="container-fluid">
            <!-- Generate Sales -->
            
            <div class="card">
                <div class="card-header">
                Generate Reseller Information
                </div>
                <div class="card-body">
                  <form action="reseller-excel.php" method="post">
                    <div class="form-group">
                      <label>Country</label>
                      <select class="form-control select2bs4" style="width: 100%;" name="country">
                      <option value="">Select Country</option>
                      <?php
                          $lugar = "SELECT DISTINCT cc_country FROM upti_country_currency";
                          $lugar_qry = mysqli_query($connect, $lugar);
                          while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                      ?>
                      <option value="<?php echo $lugar_fetch['cc_country'] ?>"><?php echo $lugar_fetch['cc_country'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <button class="btn btn-success" name="res_info">Generate All Information</button>
                  </form>
                </div>
            </div>
            
        </section>
  </div>

<?php include 'include/footer.php'; ?>