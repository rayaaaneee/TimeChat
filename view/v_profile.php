<head>
    <title>@<?= $profileUser->getUsername(); ?> - TimeChat</title>
    <script src="<?= PATH_SCRIPTS; ?>myprofile/script.js" defer></script>
    <style>
        html {
            --corner-color: <?= $profileUser->getCornerColor(); ?>
        }
    </style>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>myprofile/style.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>profile/style.css">
</head>
<?php require_once(PATH_VIEWS_PARTS . 'error.php'); ?>
<main>
    <div class="profile-container">
        <img class="profile-banner" src="<?= $profileUser->getBannerPath(); ?>" alt="Banner" draggable="false">
        <div class="left-profile" style="background-color: <?= $profileUser->getBackgroundColor(); ?>">
            <div class="profile-picture">
                <img src="<?= $profileUser->getProfilePicturePath(); ?>" alt="Profile picture" draggable="false" class="<?php if ($profileUser->isDefaultProfilePicture()) echo 'no-borders'; ?>">
            </div>
            <div class="info-profile-container">
                <div class="profile-username">
                    <div class="for-flex">
                        <h1 class="at-character">@</h1>
                        <h1 id="username-text"><?= $profileUser->getUsername(); ?></h1>
                    </div>
                </div>
            </div>
            <?php if ($hasSendFriendRequest) : ?>
                <form action="./?page=profile&user=<?= $profileUser->getId(); ?>" method="post" class="remove-friend-request form-friend">
                    <div class="input-submit-add-friend-container">
                        <input type="hidden" name="action" value="remove-friend-request">
                        <input type="submit" title="Remove your friend request" value="" class="remove-friend-request-button button-friend">
                    </div>
                    <p>Friend request sent</p>
                </form>
            <?php else : ?>
                <form action="./?page=profile&user=<?= $profileUser->getId(); ?>" method="post" class="add-friend form-friend">
                    <div class="input-submit-add-friend-container">
                        <input type="hidden" name="action" value="add-friend">
                        <input type="submit" title="Add @<?= $profileUser->getUsername(); ?> as friend" value="" class="add-friend-button button-friend">
                    </div>
                    <p>You are not not friends</p>
                </form>
            <?php endif; ?>
        </div>
        <div class="right-profile <?= $privacy; ?>">
            <div class="empty-top"></div>
            <?php if ($profileUser->isPublic()) : ?>
                <div class="middle-container">
                    <div class="profile-description">
                        <div class="for-flex-title">
                            <h1 class="title">Description</h1>
                            <div class="horizontal-bar"></div>
                            <img src="<?= PATH_IMG_PAGES; ?>myprofile/description.png" alt="description" class="img-desc" draggable="false">
                        </div>
                        <p class="content"><?= $display->printDescription($profileUser); ?></p>
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
            <?php else : ?>
                <div class="middle">
                    <div class="print-user-private">
                        <img src="<?= PATH_IMG_PAGES; ?>profile/lock-tmp.png" alt="lock">
                        <div class="private-text-container">
                            <h1>This profile is private</h1>
                            <h2>Add <?= $profileUser->getUsername(); ?> as a friend to see his profile</h2>
                        </div>
                        <div class="background" style="background-color: <?= $profileTheme->getBackgroundLock(); ?>"></div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="signed-at-container">
                <img src="<?= PATH_IMG_PAGES; ?>myprofile/calendar.png" alt="" draggable="false">
                <h1>Signed up since</h1>
                <h1><?= $profileUser->formatSignupAt(); ?></h1>
            </div>
        </div>
    </div>
</main>