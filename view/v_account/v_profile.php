<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/part/profile.css">
    <script src="<?= PATH_SCRIPTS; ?>fileinput/script.js" defer></script>
</head>
<main>
    <div class="part-container">
        <h1 class="big-title">Your profile</h1>
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Modify your profile</h1>
                <img src="<?= PATH_IMG; ?>account/modify.png" alt="modify" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
            <form action="./?page=account&part=profile" method="post" enctype="multipart/form-data">
                <textarea name="description" placeholder="Write your description"><?= $user->getDescription(); ?></textarea>
                <input type="file" name="profile-picture" id="profile-picture" hidden>
                <button type="submit" name="remove-profile-picture"></button>
                <div class="input-container">
                    <div class="choose-img-container">
                        <p onclick="openFile()">Choose a picture</p>
                        <img src="<?= $user->getProfilePicturePath(); ?>" alt="profile-picture" draggable="false">
                    </div>
                    <input type="file" name="file" accept="image/*" hidden>
                </div>
                </label>
                <input type="submit" name="update" value="Update my profile">
            </form>
            </form>
        </div>
    </div>
</main>