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
            <h1 class="m-0">Activities</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Activities</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <div class="timeline">
          <?php
            $today = date('m-d-Y');

            $act = "SELECT * FROM upti_activities WHERE activities_date = '$today' ORDER BY id DESC";
            $act_qry = mysqli_query($connect, $act);
            while ($act_fetch = mysqli_fetch_array($act_qry)) {
          ?>
          <!-- START timeline item -->
          <div>
            <i class="fas fa-user bg-info"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> <?php echo $act_fetch['activities_date'] ?> <?php echo $act_fetch['activities_time'] ?></span>
              <h3 class="timeline-header"> <?php echo $act_fetch['activities_caption'] ?></h3>
              <div class="timeline-body">
                <?php echo $act_fetch['activities_desc'] ?>
              </div>
            </div>
          </div>
          <!-- END timeline item -->
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'include/footer.php'; ?>