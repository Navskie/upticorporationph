<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<style>
    .select2-container--bootstrap4 .select2-selection {
        border-radius: 0px !important;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 0px !important;
    }
    .modal-content {
        border-radius: 0px !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: steelblue">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        </div><!-- /.row --> 
        <?php

            date_default_timezone_set("Asia/Manila");   
            $date_today = date('m-d-Y');

        ?>
        <!-- START HERE -->
        <div class="row">
            <!-- First Column Start -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- Customer Information Start -->
                <div class="card pt-3 rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="small-box bg-success rounded-0">
                                    <div class="inner">
                                        <h3>0</h3>

                                        <p>Total Items</p>  
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="small-box bg-info rounded-0">
                                    <div class="inner">
                                        <h3>0</h3>

                                        <p>Total Request</p>  
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="small-box bg-primary rounded-0">
                                    <div class="inner">
                                        <h3>0</h3>

                                        <p>Total Items</p>  
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customer Information End -->
                
            </div>
            <!-- First Column End -->
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<script src="js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
</script>
<?php include 'include/footer.php'; ?>