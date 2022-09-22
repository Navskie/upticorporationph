<?php
    if (isset($_POST['cash'])) {

        $country = $_POST['country'];
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $cashs_mop = $_FILES['cfile']['name'];
        $img_size = $_FILES['cfile']['size'];
        $img_tmp = $_FILES['cfile']['tmp_name'];

        $img_ex = pathinfo($cashs_mop, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png", "gif");

        if (in_array($img_ex_lc, $allow_ex)) {
            $new_name = uniqid("SS-", true).'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = 'images/payment/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

        $epayment_process = "INSERT INTO upti_mod (mod_img, mod_country, mod_status) VALUES ('$new_name', '$country', 'cash')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Added successfully.');window.location.href = 'order-cash.php';</script>";
        }
    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Cash Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="order-cash.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="form-group" id="preview3">
                    <div class="profile-images">
                        <img src="images/profile.png" id="upload-imgssz" width="100%">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="">Upload Receipt</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="fileuploadssz" name="cfile">
                        <label class="custom-file-label" for="e_input">Choose file</label>
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option selected="selected">Select Country</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_country_currency";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['cc_country'] ?>"><?php echo $product['cc_country'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-12">
                    <label for="">Account Branch</label>
                    <input type="text" class="form-control" name="branch" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="number" autocomplete="off" required>
                </div> -->
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="cash">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>
<script src="js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileuploadssz").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-imgssz").attr("src",x);
			console.log(event);
		});
	})
</script>