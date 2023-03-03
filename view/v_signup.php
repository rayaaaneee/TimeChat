<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>signup/style.css">
    <script src="<?= PATH_JS; ?>signup/script.js" defer></script>
</head>
<main>
    <div class="signup-form">
        <h1>Sign Up</h1>
        <form action="./?page=signup" method="post" enctype="multipart/form-data">
            <div class="grid-container">
                <div class="left-form">
                    <div class="input-container">
                        <div class="precise-text">
                            <p maxlength="30">Username</p>
                            <p class="point required">*</p>
                        </div>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-container">
                        <div class="precise-text">
                            <p>Password</p>
                            <p class="point required">*</p>
                        </div>
                        <input type="password" name="password" placeholder="Password" minlength="4" required>
                    </div>
                    <div class="input-container">
                        <div class="precise-text">
                            <p>Confirm password</p>
                            <p class="point required">*</p>
                        </div>
                        <input type="password" name="password2" placeholder="Confirm password" minlength="4" required>
                    </div>
                    <?php if ($errorMessage) : ?>
                        <div class="error-container">
                            <p><?= $errorMessage; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="right-form">
                    <div class="input-container">
                        <div class="precise-text">
                            <p>Description</p>
                            <p class="point notrequired">*</p>
                        </div>
                        <textarea name="description" placeholder="Your description" maxlength="340"></textarea>
                    </div>
                    <div class="input-container">
                        <div class="precise-text">
                            <p>Picture</p>
                            <p class="point notrequired">*</p>
                        </div>
                        <div class="choose-img-container">
                            <p onclick="openFile()">Choose a picture</p>
                            <img src="<?= PATH_PROFILE_PICTURES; ?>default/default.png" alt="profile-picture" draggable="false">
                        </div>
                        <input type="file" name="file" accept="image/*" hidden>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" name="public" id="public">
                        <label for="public">Share my profile publicly</label>
                    </div>
                </div>
            </div>
            <input type="submit" name="signup" class="validate-form-signup" value="Create account">
        </form>
        <p class="signin-text">Already have an account? <a href="./?page=signin">Sign In</a></p>
    </div>
</main>