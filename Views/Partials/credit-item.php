<div class="jcc-credit <?= $class ?>">
    <i class="icon-check-corner"></i>
    <span class="jcc-credit-cost">$<?= $credit->cost ?></span>
    <span class="jcc-credit-bonus"><?= ($credit->bonus > 0) ? '$' . $credit->bonus : 'No' ?> Bonus</span>
    <span class="jcc-credit-label"><?= $credit->label ?></span>
    <input type="radio" name="credit-item" value="<?= $credit->id ?>" />
</div>