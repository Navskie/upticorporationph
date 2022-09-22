<div class="modal fade" id="pack<?php echo $items['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Package Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <hr>
                <!-- <span>Package Details</span> -->
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <i>Item Code</i>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <i>Description</i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <i>Quantity</i>
                    </div>
                    <?php
                        $mycodes = $items['ol_code'];
                        $qty = $items['ol_qty'];

                        $packages = "SELECT * FROM upti_package WHERE package_code = '$mycodes'";
                        $packages_qry = mysqli_query($connect, $packages);
                        $pack_fetch = mysqli_fetch_array($packages_qry);

                        $code1 = $pack_fetch['package_one_code'];
                        $code11s = $pack_fetch['package_one_qty'];
                        $code11 = $code11s * $qty;

                        $code2 = $pack_fetch['package_two_code'];
                        $code22s = $pack_fetch['package_two_qty'];
                        $code22 = $code22s * $qty;

                        $code3 = $pack_fetch['package_three_code'];
                        $code33s = $pack_fetch['package_three_qty'];
                        $code33 = $code33s * $qty;

                        $code4 = $pack_fetch['package_four_code'];
                        $code44s = $pack_fetch['package_four_qty'];
                        $code44 = $code44s * $qty;

                        $code5 = $pack_fetch['package_five_code'];
                        $code55s = $pack_fetch['package_five_qty'];
                        $code55 = $code55s * $qty;

                        if($code1 != '') {
                    ?>
                    <div class="col-12"><hr></div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code1 ?></h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php
                            $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code1'";
                            $get_desc_qry = mysqli_query($connect, $get_desc);
                            $get_fetch = mysqli_fetch_array($get_desc_qry);
                        ?>
                        <h5><?php echo $get_fetch['items_desc']; ?></h5>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code11 ?></h5>
                    </div>
                    <?php } ?>
                    
                    <?php if ($code2 != '') { ?>
                    <div class="col-12"><hr></div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code2 ?></h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                                $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code2'";
                                $get_desc_qry = mysqli_query($connect, $get_desc);
                                $get_fetch = mysqli_fetch_array($get_desc_qry);
                            ?>
                            <h5><?php echo $get_fetch['items_desc']; ?></h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <h5><?php echo $code22 ?></h5>
                        </div>
                    <?php } ?>
                    
                    <?php if ($code3 != '') { ?>
                    <div class="col-12"><hr></div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code3 ?></h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                                $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code3'";
                                $get_desc_qry = mysqli_query($connect, $get_desc);
                                $get_fetch = mysqli_fetch_array($get_desc_qry);
                            ?>
                            <h5><?php echo $get_fetch['items_desc']; ?></h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <h5><?php echo $code33 ?></h5>
                        </div>
                    <?php } ?>
                    
                    <?php if ($code4 != '') { ?>
                    <div class="col-12"><hr></div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code4 ?></h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                                $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code4'";
                                $get_desc_qry = mysqli_query($connect, $get_desc);
                                $get_fetch = mysqli_fetch_array($get_desc_qry);
                            ?>
                            <h5><?php echo $get_fetch['items_desc']; ?></h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <h5><?php echo $code44 ?></h5>
                        </div>
                    <?php } ?>
                    
                    <?php if ($code5 != '') { ?>
                    <div class="col-12"><hr></div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <h5><?php echo $code5 ?></h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                                $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code5'";
                                $get_desc_qry = mysqli_query($connect, $get_desc);
                                $get_fetch = mysqli_fetch_array($get_desc_qry);
                            ?>
                            <h5><?php echo $get_fetch['items_desc']; ?></h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <h5><?php echo $code55 ?></h5>
                        </div>
                    <?php } ?>
                </div>
                <hr>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>