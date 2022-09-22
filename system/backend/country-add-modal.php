<?php
    if (isset($_POST['country'])) {

        $code = $_POST['code'];
        $country = $_POST['countrys'];
        $prices = $_POST['price'];
        $php = $_POST['php'];

        $country1 = $_POST['countrys1'];
        $prices1 = $_POST['price1'];
        $php1 = $_POST['php1'];

        $country2 = $_POST['countrys2'];
        $prices2 = $_POST['price2'];
        $php2 = $_POST['php2'];

        $country3 = $_POST['countrys3'];
        $prices3 = $_POST['price3'];
        $php3 = $_POST['php3'];

        $country4 = $_POST['countrys4'];
        $prices4 = $_POST['price4'];
        $php4 = $_POST['php4'];

        $country5 = $_POST['countrys5'];
        $prices5 = $_POST['price5'];
        $php5 = $_POST['php5'];

        $country6 = $_POST['countrys6'];
        $prices6 = $_POST['price6'];
        $php6 = $_POST['php6'];

        $country7 = $_POST['countrys7'];
        $prices7 = $_POST['price7'];
        $php7 = $_POST['php7'];

        $country8 = $_POST['countrys8'];
        $prices8 = $_POST['price8'];
        $php8 = $_POST['php8'];

        $country9 = $_POST['countrys9'];
        $prices9 = $_POST['price9'];
        $php9 = $_POST['php9'];

        $check_country = "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$code'";
        $check_country_qry = mysqli_query($connect, $check_country);
        $check_num = mysqli_num_rows($check_country_qry);

        if ($check_num == 0) {
            if ($country != '' && $prices != '' && $php != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php', '$country', '$code', '$prices', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country1 != '' && $prices1 != '' && $php1 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php1', '$country1', '$code', '$prices1', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country2 != '' && $prices2 != '' && $php2 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php2', '$country2', '$code', '$prices2', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country3 != '' && $prices3 != '' && $php3 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php3', '$country3', '$code', '$prices3', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country4 != '' && $prices4 != '' && $php4 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php4', '$country4', '$code', '$prices4', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country5 != '' && $prices5 != '' && $php5 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php5', '$country5', '$code', '$prices5', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country6 != '' && $prices6 != '' && $php6 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php6', '$country6', '$code', '$prices6', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country7 != '' && $prices7 != '' && $php7 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php7', '$country7', '$code', '$prices7', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country8 != '' && $prices8 != '' && $php8 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php8', '$country8', '$code', '$prices8', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }
            if ($country9 != '' && $prices9 != '' && $php9 != '') {
                $epayment_process = "INSERT INTO upti_country (country_total_php, country_name, country_code, country_price, country_status) VALUES ('$php9', '$country9', '$code', '$prices9', 'Active')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
            }

            echo "<script>alert('Data has been Added successfully.');window.location.href = 'item-country.php';</script>";
        } else {
            echo "<script>alert('Invalid Country.');window.location.href = 'item-country.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Country Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="item-country.php" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Item Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="code">
                            <option value="">Select Item Code</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>"><?php echo $product['code_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <label for="">Shop Price</label>
                    <input type="text" class="form-control rounded-0 border-info" name="price" autocomplete="off">
                </div>
                <div class="col-4">
                    <label for="">Earnings Price</label>
                    <input type="text" class="form-control rounded-0 border-info" name="php" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys1">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price1" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php1" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="countrys2">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price2" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php2" autocomplete="off">
                </div>
                
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys3">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price3" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php3" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys4">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price4" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php4" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys5">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price5" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php5" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys6">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price6" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php6" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys7">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price7" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php7" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys8">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price8" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php8" autocomplete="off">
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control select2bs4 rounded-0 border-info" style="width: 100%;" name="countrys9">
                            <option value="">Select Country</option>
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
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="price9" autocomplete="off">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control rounded-0 border-info" name="php9" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
            <button class="btn btn-primary rounded-0" name="country">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>