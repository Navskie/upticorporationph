<div class="modal fade" id="edit<?php echo $epayment['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Update Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/cash-edit-process.php?id=<?php echo $epayment['id']?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="form-group" id="preview3">
                        <div class="profile-images">
                            <img src="template.png" id="upload-imgssq" width="100%">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="">Upload Receipt</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileuploadssq" name="cfile">
                            <label class="custom-file-label" for="e_input">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option value="<?php echo $epayment['mod_country'] ?>"><?php echo $epayment['mod_country'] ?></option>
                            <?php
                            $product_sql = "SELECT * FROM upti_country";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['country_name'] ?>"><?php echo $product['country_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-12">
                    <label for="">Account Branch</label>
                    <input type="text" class="form-control" name="branch" autocomplete="off" required value="<?php //echo $epayment['mod_branch'] ?>">
                </div>
                <div class="col-12">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required value="<?php //echo $epayment['mod_name'] ?>">
                </div>
                <div class="col-12">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="number" autocomplete="off" required value="<?php //echo $epayment['mod_number'] ?>">
                </div> -->
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
            <button class="btn btn-primary rounded-0" name="cashupdate">Update</button>
        </form>
        </div>
    </div>
    </div>
</div>
<script src="./js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileuploadssq").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-imgssq").attr("src",x);
			console.log(event);
		});
	})
</script>