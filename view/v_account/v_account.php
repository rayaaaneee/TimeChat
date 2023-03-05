<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/part/account.css">
</head>
<?php require_once(PATH_VIEWS . 'error/v_error.php'); ?>
<div class="part-container">
    <h1 class="big-title">Your account</h1>
    <div class="account-part">
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Modify your username</h1>
                <img src="<?= PATH_IMG; ?>account/modify.png" alt="modify" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
        </div>
        <p class="warning">Your username is your unique identifier, you will connect with the new</p>
        <form method="post" action="./?page=account" class="form-username form-account">
            <div class="account-text-container">
                <h2>New username</h2>
                <h2>Confirm password</h2>
            </div>
            <div class="input-container">
                <input type="text" name="username" placeholder="<?= $user->getUsername(); ?>" value="" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Modify" name="modify-username" class="btn-modify">
            </div>
        </form>
    </div>
    <div class="account-part">
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Modify your password</h1>
                <img src="<?= PATH_IMG; ?>account/modify.png" alt="modify" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
        </div>
        <p class="warning">For security reasons, your password must contain at least 8 characters</p>
        <form method="post" action="./?page=account" class="form-password form-account">
            <div class="account-text-container">
                <h2>Actual password</h2>
                <h2>New password</h2>
                <h2>Confirm new password</h2>
            </div>
            <div class="input-container">
                <input type="password" name="actual-password" placeholder="Actual password" required minlength="4">
                <input type="password" name="new-password" placeholder="New password" minlength="4" required>
                <input type="password" name="confirm-new-password" minlength="4" placeholder="New password" required>
                <input type="submit" name="modify-password" value="Modify" class="btn-modify">
            </div>
        </form>
    </div>
    <div class="account-part">
        <div class="account-part-title-container">
            <div class="flex-row title-img-container">
                <h1 class="title-part">Delete your account</h1>
                <img src="<?= PATH_IMG; ?>account/delete.png" alt="delete" class="title-img" draggable="false">
            </div>
            <div class="part-separator-bar"></div>
        </div>
        <p class="warning">Your account and all your datas will be deleted permanently</p>
        <form method="post" action="./?page=account" class="form-delete form-account">
            <div class="account-text-container">
                <h2>Confirm password</h2>
            </div>
            <div class="input-container">
                <input type="password" name="username" placeholder="Your password">
                <input type="button" value="Delete my account" class="btn-delete">
            </div>
            <div class="are-you-sure">
                <h2>Are you sure to delete your account ?</h2>
                <input type="submit" value="Yes" class="btn-delete">
                <input type="submit" value="No" class="btn-delete">
            </div>
        </form>
    </div>

</div>