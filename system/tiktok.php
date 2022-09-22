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
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#entry">Add Entry</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Raffle Code</th>
                    <th class="text-center">Reseller Name</th>
                    <th class="text-center">Date</th>
                  </tr>
                  </thead>
                  <?php
                    $account = "SELECT * FROM upti_raffle ORDER BY id DESC;
                    ";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($tiktok = mysqli_fetch_array($account_qry)) {
                  ?>
                  <tr>
                    <td><?php echo $number ?></td>
                    <td class="text-center"><?php echo $tiktok['raffle_code'] ?> - <?php echo $tiktok['raffle_number'] ?></td>
                    <td class="text-center"><?php echo $tiktok['raffle_code'] ?></td>
                    <td class="text-center"><?php echo $tiktok['raffle_date'] ?> - <?php echo $tiktok['raffle_time'] ?></td>
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
      </div>
    </section>
  </div>
<?php include 'backend/tiktok-entry.php'; ?>
<?php include 'include/footer.php'; ?>