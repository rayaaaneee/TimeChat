<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>header/style.css">
    <link rel="stylesheet" href="<?= PATH_CSS; ?>/html.css">
    <link rel="icon/shortcut icon" href="<?= PATH_IMG; ?>favicon/clock.png" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="menu-container">
            <ul>
                <div class="menu-part-one">
                    <li class="go-home">
                        <a href="./" class="view-home menu-view">
                            <img src="<?= PATH_IMG; ?>favicon/clock.png" alt="logo">
                        </a>
                    </li>
                    <form action="./" class="search-user" method="get">
                        <input type="hidden" name="page" value="search">
                        <input type="text" name="search" class="search-input" placeholder="Rechercher un utilisateur..." required>
                        <button type="submit">
                            <img src="<?= PATH_IMG; ?>icon/search.png" alt="search">
                        </button>
                    </form>
                </div>
                <div class="menu-part-two">
                    <li>
                        <a href="./?page=message" class="view-messages menu-view">
                            <img src="<?= PATH_IMG; ?>icon/message.png" alt="home">
                        </a>
                    <li>
                        <a href="./?page=myaccount" class="view-account menu-view">
                            <img src="<?= PATH_IMG; ?>icon/user.png" alt="profile">
                        </a>
                    </li>
                    <li>
                        <a href="./?page=notification" class="view-notifications menu-view">
                            <img src="<?= PATH_IMG; ?>icon/notification.png" alt="notification">
                        </a>
                    </li>
                </div>
                <div class="menu-part-three">

                </div>
            </ul>
        </nav>
    </header>