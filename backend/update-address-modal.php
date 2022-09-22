<div class="modal fade" id="address<?php echo $address['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Address</h5>
            </div>
            <div class="modal-body">
                <form action="backend/update-address-process.php?id=<?php echo $address['id'] ?>" method="post">
                    <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>House #</label>
                                    <input type="text" class="form-control" name="house" value="<?php echo $address['add_house'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Barangay</label>
                                    <input type="text" class="form-control" name="barangay" value="<?php echo $address['add_barangay'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo $address['add_city'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" class="form-control" name="province" value="<?php echo $address['add_province'] ?>">
                                </div>
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger bg-success" name="address">Update Address</button>
                </form>
            </div>
        </div>
    </div>
</div>