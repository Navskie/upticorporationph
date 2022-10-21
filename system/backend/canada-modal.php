<div class="modal fade" id="canada<?php echo $get_transaction_fetch['trans_poid']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center"><label for="">PAYMENT WARNING</label></h4>
        </div>
        <?php $state_trans = $get_transaction_fetch['trans_state']; ?>
        <div class="modal-body">
        <form action="order-payment.php?office=<?php echo $get_transaction_fetch['trans_poid']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                  <?php if ($state_trans != 'ALBERTA') { ?>
                    <img src="./images/manual/ontario.jpg" class="w-100 img-responsive" alt="">
                  <?php } else { ?>
                    <img src="./images/manual/alberta.jpg" class="w-100 img-responsive" alt="">
                  <?php } ?>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn"></button>
          <button class="btn btn-info rounded-0" name="bank">Proceed</button>
        </form>
        </div>
        
    </div>
    </div>
</div>