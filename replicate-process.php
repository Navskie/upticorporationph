<?php
  session_start();

  $id = $_GET['id'];

  $_SESSION['replicate_code'] = $id;

  header('location: http://localhost/betatest/shop.php');

?>