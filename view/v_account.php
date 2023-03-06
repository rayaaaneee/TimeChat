<head>
    <title>Manage Account</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/style.css">
</head>
<main>
    <div class="manage-account-container">
        <div class="manage-account-menu-container">
            <div class="buttons-container">
                <a href="./?page=account" class="redirect-button <?= getClassPage("account", $part); ?>">
                    <img src="<?= PATH_IMG; ?>account/account.png" alt="account-logo">
                    <span>Account</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=profile" class="redirect-button <?= getClassPage("profile", $part); ?>">
                    <img src="<?= PATH_IMG; ?>account/profile.png" alt="profile-logo">
                    <span>Profile</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=data" class="redirect-button <?= getClassPage("data", $part); ?>">
                    <img src="<?= PATH_IMG; ?>account/data.png" alt="notifications-logo">
                    <span>Datas</span>
                </a>
                <div class="separator-bar"></div>
                <a href="./?page=account&part=favorite" class="redirect-button <?= getClassPage("favorite", $part); ?>">
                    <img src="<?= PATH_IMG; ?>account/favorite.png" alt="notifications-logo">
                    <span>Favorites</span>
                </a>
            </div>
        </div>
        <div class="content-container">
            <?php require_once(PATH_VIEWS . 'account/v_' . $part . '.php'); ?>
        </div>
    </div>
</main>