<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>header/style.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>/html.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="icon/shortcut icon" href="<?= PATH_IMG; ?>favicon/clock.png" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="menu-container">
            <ul>
                <div class="menu-part-one">
                    <li class="go-home" data-title="Home">
                        <a href="./" class="view-home menu-view">
                            <img src="<?= PATH_IMG; ?>favicon/clock.png" alt="logo">
                        </a>
                    </li>
                    <form action="./" class="search-user" method="get">
                        <input type="hidden" name="page" value="search">
                        <input type="text" name="search" class="search-input" placeholder="Search an user ...">
                        <div class="vertical-red-bar"></div>
                        <button type="submit">
                            <img src="<?= PATH_IMG; ?>icon/search.png" alt="search">
                        </button>
                    </form>
                </div>
                <div class="menu-part-two">
                    <li data-title="Messages">
                        <a href="./?page=message" class="view-messages menu-view">
                            <img src="<?= PATH_IMG; ?>icon/message.png" alt="home">
                        </a>
                    </li>
                    <li data-title="Groups">
                        <a href="./?page=group" class="view-groups menu-view">
                            <img src="<?= PATH_IMG; ?>icon/group.png" alt="group">
                        </a>
                    </li>
                    <li data-title="Friends">
                        <a href="./?page=friend" class="view-account menu-view">
                            <img src="<?= PATH_IMG; ?>icon/friends.png" alt="profile">
                        </a>
                    </li>
                    <li data-title="Notifications">
                        <a href="./?page=notification" class="view-notifications menu-view <?= getClass($displayCircleNotifications); ?>" number="<?= $nbNotifications; ?>">
                            <img src="<?= PATH_IMG; ?>icon/notification.png" alt="notification">
                        </a>
                    </li>
                </div>
                <div class="menu-part-three">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li data-title="Profile">
                            <a href="./?page=myprofile" class="view-profile menu-view">
                                <img src="<?= $user->getProfilePicturePath(); ?>" alt="profile">
                            </a>
                        </li>
                        <li data-title="Account">
                            <a href="./?page=account" class="view-account menu-view">
                                <img src="<?= PATH_IMG; ?>icon/account.png" alt="setting">
                            </a>
                        </li>
                        <li data-title="Settings">
                            <a href="./?page=settings" class="view-settings menu-view">
                                <img src="<?= PATH_IMG; ?>icon/setting.png" alt="setting">
                            </a>
                        </li>
                        <li data-title="Sign Out">
                            <form action="./?page=signin" method="post" class="view-signout">
                                <button type="submit" name="signout" class="signout-btn">
                                    <img src="<?= PATH_IMG; ?>icon/signout.png" alt="signout">
                                </button>
                            </form>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="./?page=signin" class="view-signin">
                                <p>Sign In</p>
                                <img src="<?= PATH_IMG; ?>icon/signin.png" alt="signin">
                            </a>
                        </li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>