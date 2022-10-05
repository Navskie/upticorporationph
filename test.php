<?php include 'include/header.php' ?>
  <form action="profile-test.php?id=<?php echo $_SESSION['code'] ?>" method="post">
    <button class="btn btn-danger" name="replicate">Replicate</button>
  </form>
<?php include 'include/footer.php' ?>