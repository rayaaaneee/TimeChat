<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>signin/style.css">
</head>
<main>
    <div class="signin-container">
        <div class="carousel-container">

        </div>
        <div class="signin-form-container">
            <?php if ($error) : ?>
                <div class="error-message">
                    <p><?= $error; ?></p>
                    <img src="<?= PATH_IMG; ?>signin/error.png" alt="error" draggable="false">
                </div>
            <?php elseif ($success) : ?>
                <div class="success-message">
                    <p><?= $success; ?></p>
                    <img src="<?= PATH_IMG; ?>signin/success.png" alt="success" draggable="false">
                </div>
            <?php endif; ?>
            <h1>Sign In to TimeChat</h1>
            <form action="./?page=signin" method="post" class="signin-form">
                <input type="text" name="username" placeholder="Your username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <input type="submit" name="signin" value="Sign In">
            </form>
            <p class="signup-text">Don't have an account? <a href="./?page=signup">Sign Up</a></p>
        </div>
    </div>
</main>