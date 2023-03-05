<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/part/profile.css">
    <script src="<?= PATH_SCRIPTS; ?>fileinput/script.js" defer></script>
    <script src="<?= PATH_SCRIPTS; ?>account/profile.js" defer></script>
</head>
<main id="second-main">
    <div class="part-container">
        <h1 class="big-title">Your profile</h1>
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Modify your profile</h1>
                <img src="<?= PATH_IMG; ?>account/modify.png" alt="modify" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
        </div>
        <form action="./?page=account&part=profile" method="post" enctype="multipart/form-data" class="profile-form-container">
            <div class="description-container">
                <div class="title-container description-title-container">
                    <img src="<?= PATH_IMG; ?>account/description.png" alt="icon description" draggable="false">
                    <h2>Description : </h1>
                </div>
                <textarea name="description" placeholder="Write your description"><?= $user->getDescription(); ?></textarea>
            </div>
            <div class="input-container">
                <div class="profile-picture-container">
                    <div class="title-container pp-title-container">
                        <img src="<?= PATH_IMG; ?>account/profile-picture-icon.png" alt="icon-profile-picture" draggable="false">
                        <h2>Profile picture : </h1>
                    </div>
                    <input type="file" name="profile-picture" id="profile-picture" hidden>
                    <div class="choose-img-container">
                        <div class="text-container">
                            <p onclick="openFile()">Choose a picture</p>
                            <h3 class="filename"><?= $user->getProfilePicture(); ?></p>
                        </div>
                        <div class="img-container">
                            <img src="<?= $user->getProfilePicturePath(); ?>" alt="profile-picture" draggable="false">
                            <div class="privacy-animation-container">
                                <img src="<?= PATH_IMG; ?>account/public-top.png" alt="privacy" class="image-top" draggable="false">
                                <img class="image-bottom" src="<?= PATH_IMG; ?>account/private-bottom.png" alt="privacy" draggable="false">
                            </div>
                            <?php if (!$user->isDefaultProfilePicture()) : ?>
                                <button type="submit" name="remove-profile-picture" title="Remove my profile picture"></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="file" name="file" accept="image/*" hidden>
                </div>
            </div>
            <div class="privacy-container">
                <div class="title-container privacy-title-container">
                    <img src="<?= PATH_IMG; ?>account/earth.png" alt="icon-profile-picture" draggable="false">
                    <h2>Your privacy : </h1>
                </div>
                <div class="privacy-input-container">
                    <div class="text-privacy-container">
                        <img src="<?= PATH_IMG; ?>account/info-red.png" alt="privacy" draggable="false">
                        <p>Your account is currently <?= echoPublic($isPublic); ?>
                        </p>
                    </div>
                    <div class="input-container">
                        <input type="checkbox" name="is-public" id="public" <?= echoChecked($isPublic); ?>>
                        <label for="public">Share my profile publicly</label>
                    </div>
                </div>
            </div>
            <input type="submit" name="update-profile" value="Update my profile">
        </form>
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Choose profile theme</h1>
                <img src="<?= PATH_IMG; ?>account/theme2.png" alt="modify" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
        </div>
    </div>
</main>