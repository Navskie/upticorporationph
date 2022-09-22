<div class="modal fade" id="office<?php echo $get_transaction_fetch['trans_poid']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center"><label for="">YOUR DIRECT MAIL BOX OPTION</label></h4>
        </div>
        <div class="modal-body">
        <form action="backend/add-office-process.php?office=<?php echo $get_transaction_fetch['trans_poid']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <!-- <label for="" class="text-center">YOU DIRECT MAIL BOX PREFERENCE</label> -->
                    <p class="text-center">
                        By clicking <b>"ACCEPT"</b> you agree that Uptimised parties gives no warranty and accepts no responsibility or liability for any loss or damages you experience including any claims of product defects.
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button class="btn"></button>
        <button class="btn btn-info rounded-0" name="accept">ACCEPT</button>
        </form>
        </div>
        
    </div>
    </div>
</div>