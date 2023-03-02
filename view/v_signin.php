<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>signin/style.css">
</head>
<main>
    <div class="signin-container">
        <div class="carousel-container">

        </div>
        <div class="signin-form-container">
            <h1>Sign In to TimeChat</h1>
            <form action="./?page=signin" method="post" class="signin-form">
                <input type="text" name="username" placeholder="Your username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="signin" value="Sign In">
            </form>
        </div>
    </div>
</main>