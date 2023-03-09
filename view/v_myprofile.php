<head>
    <title>My Profile</title>
    <script src="<?= PATH_SCRIPTS; ?>myprofile/script.js" defer></script>
    <style>
        html {
            --corner-color: <?= $user->getCornerColor(); ?>;
        }
    </style>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>myprofile/style.css">
</head>
<main>
    <div class="profile-container">
        <img class="profile-banner" src="<?= $profileTheme->getBannerPath(); ?>" alt="Banner" draggable="false">
        <div class="left-profile" style="background-color: <?= $user->getBackgroundColor(); ?>">
            <div class="profile-picture">
                <img src="<?= $user->getProfilePicturePath(); ?>" alt="Profile picture" draggable="false" class="<?php if ($user->isDefaultProfilePicture()) echo 'no-borders'; ?>">
            </div>
            <div class="info-profile-container">
                <div class="profile-username">
                    <div class="for-flex">
                        <h1 class="at-character">@</h1>
                        <h1 id="username-text"><?= $user->getUsername(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-profile">
            <div class="empty-top">

            </div>
            <div class="middle-container">
                <div class="profile-description">
                    <div class="for-flex-title">
                        <h1 class="title">Description</h1>
                        <div class="horizontal-bar"></div>
                        <img src="<?= PATH_IMG_PAGES; ?>myprofile/description.png" alt="description" class="img-desc" draggable="false">
                    </div>
                    <p class="content"><?= $display->printDescription($user); ?></p>
                </div>
                <div class="profile-nb-friends">
                    <div class="for-flex-title">
                        <h1 class="title">Friends</h1>
                        <div class="horizontal-bar"></div>
                        <img src="<?= PATH_IMG_PAGES; ?>myprofile/friends.png" alt="friends" class="img-friends" draggable="false">
                    </div>
                    <p class="content">0</p>
                </div>
            </div>
            <div class="profile-is-public">
                <?= $display->formatUserIsPublicMyProfile($user); ?>
            </div>
            <div class="signed-at-container">
                <img src="<?= PATH_IMG_PAGES; ?>myprofile/calendar.png" alt="" draggable="false">
                <h1>Signed up since</h1>
                <h1><?= $user->formatSignupAt(); ?></h1>
            </div>
        </div>
    </div>
</main>