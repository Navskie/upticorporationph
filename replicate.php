<?php include 'include/header.php'; ?>
<?php 

  $id = $_GET['id'];

  $info_stmt = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$id'");
  $info_fetch = mysqli_fetch_array($info_stmt);

?>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 pt-3">
        <div class="card px-2 py-3 border border-0">
          <form action="replicate-process.php?id=<?php echo $id ?>" method="post">
            <div class="row">
              <div class="col-12">
                <?php echo $info_fetch['users_img'] ?>
                <?php if ($info_fetch['users_img'] == '') { ?>
                <img src="assets/images/main/default.jpg" alt="" class="image-responsive w-100">
                <?php } else { ?>
                <img src="system/images/profile/<?php echo $info_fetch['users_img'] ?>" alt="" class="image-responsive w-100">
                <?php } ?>
              </div>
              <div class="col-12">
                <h5>Hi I'm </h5><h5 class="text-center font-weight-bold text-uppercase"><?php echo $info_fetch['users_name'] ?></h5>
              </div>
              <div class="col-12 px-5">
                <h6 class="text-center">Click Shop Now to start your order</h6>
                <button class="btn btn-success w-100">SHOP NOW <i class="uil uil-arrow-right"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-4"></div>
    </div>
  </div>

<?php include 'include/footer.php'; ?>