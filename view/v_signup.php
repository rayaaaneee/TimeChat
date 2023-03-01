<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>signup/style.css">
</head>
<main>
    <div class="carousel-container">

    </div>
    <div class="signup-container">
        <div class="signup-form">
            <h1>Sign Up</h1>
            <form action="./?page=signup" method="post">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirm" placeholder="Confirm Password" required>
                <input type="submit" name="signup" value="Sign Up">
            </form>
        </div>
    </div>
</main>