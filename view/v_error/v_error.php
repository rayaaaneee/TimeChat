<?php
if ($needsDisplay) {
    $tmp = '';
    if ($isSuccess) {
        $tmp = 'success';
    } else {
        $tmp = 'error';
    }
?>

    <head>
        <link rel="stylesheet" href="<?= PATH_CSS; ?>error/style.css">
        <script src="<?= PATH_SCRIPTS; ?>error/script.js" defer></script>
    </head>
    <div class="<?= $tmp; ?>-message-container message-container">
        <div class="cross-container">
            <div class="cross">
                <div class="bar bar1"></div>
                <div class="bar bar2"></div>
            </div>
        </div>
        <img src="<?= PATH_IMG . 'account/' . $tmp . '.png' ?>" alt="<?= $tmp; ?>" draggable="false">
        <div class="<?= $tmp; ?>-message">
            <p><?= $returnMessage; ?></p>
        </div>
    </div>
<?php
}
