<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>signin/style.css">
</head>
<main>
    <?php require_once(PATH_VIEWS . 'error/v_error.php'); ?>
    <div class="signin-container">
        <div class="carousel-container">
            <?php require_once(PATH_VIEWS . 'error/v_error.php'); ?>
        </div>
        <div class="signin-form-container">
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