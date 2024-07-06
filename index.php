<?php

declare(strict_types=1);

require 'currency.php';
$currency = new Currency();
$amount = $_POST['amount'] ?? '';
$selectedCurrency = $_POST['Ccy'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <form action="index.php" method="post">
        <div class="row mb-3">
            <div class="col">
                <label for="Ccy" class="form-label">Choose Currency</label>
                <select id="Ccy" class="form-select" name="Ccy">
                    <?php
                    foreach ($currency->customCurrencies() as $currencyName => $rate) {
                        $selected = ($selectedCurrency === $currencyName) ? 'selected' : '';
                        echo "<option value='$currencyName' $selected>$currencyName</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <fieldset>
            <legend>Currency Converter</legend>
            <div class="mb-3">
                <label for="amount" class="form-label">UZS =&gt; <?php echo $selectedCurrency; ?></label>
                <input type="text" id="amount" class="form-control" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            </div>
            <div class="mb-3">
                <label for="convertedAmount" class="form-label"><?php echo $selectedCurrency; ?></label>
                <input type="text" id="convertedAmount" class="form-control" value="<?php
                if (!empty($amount) && is_numeric($amount)) {
                    echo number_format($currency->exchange((float) $amount, $selectedCurrency), 2);
                } ?>">
            </div>
            <button type="submit" class="btn btn-primary">Exchange</button>
        </fieldset>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
