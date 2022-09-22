<div class="modal fade" id="upload<?php echo $rows['req_reference']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;"">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Upload Payment Receipt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/po-upload-file-process.php?id=<?php echo $rows['req_reference']; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-3">

                </div>

                <div class="col-6">
                    <img src="template.png" alt="" class="img-fluid" id="upload-img">
                    <br><br>
                </div>

                <div class="col-3">

                </div>

                <div class="col-12">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileupload" name="file" id="fileupload">
                            <label class="custom-file-label" for="b_input" style="border-radius: 0 !important">Click Here to Upload Receipt</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-success rounded-0" name="uploadfile">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
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