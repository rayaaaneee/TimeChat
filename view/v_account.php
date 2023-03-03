<head>
    <title>Manage Account</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/style.css">
    <script src="js/v_account.js"></script>
</head>
<main>
    <div class="manage-account-container">
        <div class="manage-account-menu-container">
            <div class="buttons-container">
                <a href="./?page=account" class="redirect-button">
                    <img src="<?= PATH_IMG; ?>account/account.png" alt="account-logo">
                    <span>Account</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=profile" class="redirect-button">
                    <img src="<?= PATH_IMG; ?>account/profile.png" alt="profile-logo">
                    <span>Profile</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=data" class="redirect-button">
                    <img src="<?= PATH_IMG; ?>account/data.png" alt="notifications-logo">
                    <span>Datas</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=favorites" class="redirect-button">
                    <img src="<?= PATH_IMG; ?>account/favorite.png" alt="notifications-logo">
                    <span>Favorites</span>
                </a>
            </div>
        </div>
        <div class=" content-container">

        </div>
    </div>
</main>