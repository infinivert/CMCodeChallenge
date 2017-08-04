<?php

    require(APPPATH . 'Views/Partials/head.php');
    
    // Include additional header scripts or styles here
?>

<?php
    require(APPPATH . 'Views/Partials/body.php');
    // Include view-specific output here
?>
<form action="<?= APPURL ?>Clients" method="post" autocomplete="off">
    <div class="jcc-credits">

<?php
    if (!empty($credits) && is_array($credits)) :
        foreach ($credits as $credit) :
            if (!empty($credit)&& is_a($credit, 'JCC\\Models\\CreditModel')) :
                include(APPPATH . 'Views/Partials/credit-item.php');
            endif;
        endforeach;
    endif;
?>

    </div>

    <div class="jcc-payment">
        <h4 class="jcc-payment-heading">Complete Purchase</h4>
        <div class="jcc-payment-methods">
            <label>
                <input type="radio" name="payment-method" value="cc">
                Credit Card
            </label>
            <label>
                <input type="radio" name="payment-method" value="paypal">
                Paypal
            </label>

            <div class="jcc-payment-box jcc-cc">
                <div class="jcc-payemnt-box-container">
                    <input type="text" class="jcc-cc-number" name="cc-number" placeholder="Card Number" required="required">
                    <input type="text" class="jcc-cc-exp" name="cc-exp" placeholder="MM / YY" required="">
                    <input type="text" class="jcc-cc-cvc" name="cc-cvc" placeholder="CVC" required="">
                </div>
                <input type="submit" class="jcc-button" name="payment-type-cc" value="Buy Credits">
            </div>
            <div class="jcc-payment-box jcc-paypal">
                <div class="jcc-payemnt-box-container">
                </div>
                <a class="jcc-button" name="payment-type-paypal">Continue on <span class="jcc-paypal-logo">Paypal</span></a>
            </div>
        </div>
    </div>
</form>
<?php
    require(APPPATH . 'Views/Partials/subfooter.php');

    // Include additional scripts here
?>

<?php
    require(APPPATH . 'Views/Partials/footer.php');
