<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/part/data.css">
</head>
<div class="part-container">
    <h1 class="big-title">Your datas</h1>
    <div class="account-part-title-container">
        <div class="flex-row title-img-container">
            <h1 class="title-part">Generate my datas</h1>
            <img src="<?= PATH_IMG_PAGES; ?>account/mini-data.png" alt="modify" class="title-img" draggable="false">
        </div>
        <div class="part-separator-bar"></div>
        <form action="./?page=account&part=data" class="generate-datas" method="post">
            <input type="submit" name="generate" value="Download" class="generate-btn">
        </form>
    </div>
    <div class="account-part-title-container">
        <div class="flex-row title-img-container">
            <h1 class="title-part">TimeChat & datas</h1>
            <img src="<?= PATH_IMG_PAGES; ?>account/mini-data.png" alt="modify" class="title-img" draggable="false">
        </div>
        <div class="part-separator-bar"></div>
    </div>
</div>