<div class="modal fade" id="check<?php echo $account_fetch['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Withdrawal Approval</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="backend/withdraw-check-process.php?id=<?php echo $account_fetch['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="">Remarks</label>
                        <textarea name="comment" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="profile-images">
                            <img src="images/profile.png" id="upload-img" width="100%">
                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <div class="form-group">
                            <label for="">Upload Receipt</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileuploads" name="wfile">
                                <label class="custom-file-label" for="fileupload">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
                <button class="btn btn-primary rounded-0" name="check">Approve</button>
            </form>
        </div>
    </div>
    </div>
</div>
<script src="./js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileuploads").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
</script>