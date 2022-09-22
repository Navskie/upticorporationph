<div class="modal fade" id="edit<?php echo $code['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Announcements</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="backend/announce-edit-process.php?id=<?php echo $code['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- <div class="col-12">
                        <label for="">Announcement Head</label>
                        <input type="text" class="form-control" name="head" autocomplete="off" placeholder="Optional">
                        <br>
                    </div>
                    <div class="col-12">
                        <label for="">Announcement Descriptions</label>
                        <textarea name="desc" id="" cols="30" rows="5" class="form-control" placeholder="Optional"></textarea>
                    </div> -->
                    <div class="col-lg-12 col-md-4 col-sm-12">
                        <div>
                            <br>
                            <img class="img-responsive" src="images/slide/slide1.jpg" id="upload-img2" width="100%">
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="form-group">
                        <label for="">Upload Announcement Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileupload2" name="cfile">
                                <label class="custom-file-label" for="b_input">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-6">
                        <label for="">Expiry Date</label>
                        <input type="date" class="form-control" name="until" autocomplete="off">
                        <br>
                    </div> -->
                    <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="status">
                            <option value="<?php echo $code['announce_status']; ?>"><?php echo $code['announce_status']; ?></option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" name="announcementedit">Update</button>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="./js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileupload2").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img2").attr("src",x);
			console.log(event);
		});
	})
</script>