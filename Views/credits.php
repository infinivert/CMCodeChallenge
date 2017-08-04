<?php

    require(APPPATH . 'Views/Partials/head.php');
    
    // Include additional header scripts or styles here
?>
        <!-- Custom styles for this template -->
        <link href="<?= APPURL ?>Assets/Styles/app.css" rel="stylesheet">
<?php
    require(APPPATH . 'Views/Partials/body.php');
    // Include view-specific output here
?>
<form class="jcc-app" action="<?= APPURL ?>Clients" method="post" autocomplete="off">
    <div class="jcc-credits">

<?php
    if (!empty($credits) && is_array($credits)) :
        foreach ($credits as $credit) :
            if (!empty($credit)&& is_a($credit, 'JCC\\Models\\CreditModel')) :
                $class = '';
                if ($credit->id == $defaultCredit) {
                    $class = 'active';
                    $default_cost = $credit->cost;
                }
                include(APPPATH . 'Views/Partials/credit-item.php');
            endif;
        endforeach;
    endif;
?>

    </div>

    <div class="jcc-payment">
        <h4 class="jcc-payment-heading">Complete Purchase</h4>
        <div class="jcc-payment-methods">
            <span class="jcc-payment-method-heading">Payment Method:</span>
            <label class="jcc-radio checked">
                <input type="radio" name="payment-method" value="cc">
                <i class="icon-credit-card"></i>
                Credit Card
            </label>
            <label class="jcc-radio">
                <input type="radio" name="payment-method" value="paypal">
                <i class="icon-paypal-card"></i>
                Paypal
            </label>

            <div class="jcc-payment-box jcc-cc">
                <div class="jcc-payment-box-container">
                    <span class="jcc-payment-box-info">
                        <span class="jcc-radio checked"></span>
                        <i class="icon-card-visa"></i>
                        <label class="jcc-checkbox checked">
                            <input type="checkbox" value="save-cc" />
                            Save
                        </label>
                        <span class="jcc-payment-box-info-cost" data-update-cost="text"><?= $default_cost ?></span>
                    </span>
                    <input type="text" class="jcc-cc-number" name="cc-number" placeholder="Card Number" required="required">
                    <i class="icon-lock"></i>
                    <input type="text" class="jcc-cc-exp" name="cc-exp" placeholder="MM / YY" required="required">
                    <input type="text" class="jcc-cc-cvc" name="cc-cvc" placeholder="CVC" required="required">
                </div>
                <input type="submit" class="jcc-button" name="payment-type-cc" data-update-value="" data-update-value-before="Buy $" data-update-value-after=" Credits" value="Buy <?= $default_cost ?> Credits">
            </div>
            <div class="jcc-payment-box jcc-paypal">
                <div class="jcc-payment-box-container">
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
<script src="<?= APPURL ?>Assets/Scripts/app.js"></script>
<?php
    require(APPPATH . 'Views/Partials/footer.php');
