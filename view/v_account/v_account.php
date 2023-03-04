<head>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>account/part/account.css">
</head>
<div class="part-container">
    <h1 class="big-title">Your account</h1>
    <div class="account-part">
        <div class="account-part-title-container">
            <h1 class="title-part">Modify your username</h1>
            <div class="part-separator-bar"></div>
        </div>
        <form method="post" action="./?page=account" class="form-username form-account">
            <div class="for-flex-part">
                <h2>New username</h2>
                <input type="text" name="username" placeholder="Firstname" value="<?= $user->getUsername(); ?>" required>
            </div>
            <div class="for-flex-part">
                <h2>Confirm password</h2>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="button-submit-container">
                <input type="submit" value="Modify" class="btn-modify">
            </div>
        </form>
    </div>
    <div class="account-part">
        <div class="account-part-title-container">
            <h1 class="title-part">Modify your password</h1>
            <div class="part-separator-bar"></div>
        </div>
        <form method="post" action="./?page=account" class="form-password form-account">
            <div class="for-flex-part">
                <h2>Actual password</h2>
                <input type="password" name="actual-password" placeholder="Actual password" required>
            </div>
            <div class="for-flex-part">
                <h2>New password</h2>
                <input type="password" name="new-password" placeholder="New password">
            </div required>
            <div class="for-flex-part">
                <h2>Confirm new password</h2>
                <input type="password" name="confirm-new-password" placeholder="New password">
            </div required>
            <div class="button-submit-container">
                <input type="submit" value="Modify" class="btn-modify">
            </div>
        </form>
    </div>
    <div class="account-part">
        <div class="account-part-title-container">
            <h1 class="title-part">Delete your account</h1>
            <div class="part-separator-bar"></div>
        </div>
        <form method="post" action="./?page=account" class="form-delete form-account">
            <div class="for-flex-part">
                <h2>Confirm password</h2>
                <input type="password" name="username" placeholder="Your password">
            </div>
            <div class="button-submit-container">
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