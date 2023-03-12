<head>
    <?php if ($nbNotifications > 0) {
        $titlePage = 'Notifications (' . $nbNotifications . ')';
    } else {
        $titlePage = 'Aucune notification';
    } ?>
    <title><?= $titlePage; ?> - TimeChat</title>
    <link rel="stylesheet" href="<?= PATH_CSS; ?>notification/style.css">
</head>
<main>
    <div class="title-page-container">
        <h1><?= $title; ?></h1>
        <?php if ($nbNotifications > 0) : ?>
            <div class="nb-notifications">
                <span><?= $nbNotifications; ?></span>
            </div>
        <?php endif; ?>
    </div>
    <div class="notification-menu-container">
        <nav>
            <ul>
                <li>
                    <a href="./?page=notification&part=message" class="<?= echoActive($part, "message"); ?>">
                        <p>Messages</p>
                    </a>
                    <?php if ($nbNotificationsMessages > 0) : ?>
                        <div class="nb-notifications">
                            <span><?= $nbNotificationsMessages; ?></span>
                        </div>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="./?page=notification&part=friend" class="<?= echoActive($part, "friend"); ?>">
                        <p>Friends</p>
                    </a>
                    <?php if ($nbNotificationsFriends > 0) : ?>
                        <div class="nb-notifications">
                            <span><?= $nbNotificationsFriends; ?></span>
                        </div>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="./?page=notification&part=group" class="<?= echoActive($part, "group"); ?>">
                        <p>Groups</p>
                    </a>
                    <?php if ($nbNotificationsGroups > 0) : ?>
                        <div class="nb-notifications">
                            <span><?= $nbNotificationsGroups; ?></span>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <div class=" middle-bar">
        </div>
    </div>
    <?php require_once(PATH_CONTROLLERS . 'notification/c_' . $part . '.php'); ?>
</main>