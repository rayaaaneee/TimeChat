<?php

require_once(PATH_CLASSES . 'Notification.php');

class ManageNotifications
{
    private array $notifications;

    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function getNotifications(): array
    {
        return $this->notifications;
    }

    public function getNotificationsByType(int $type): array
    {
        $notifications = [];

        foreach ($this->notifications as $notification) {
            if ($notification->getType() == $type) {
                $notifications[] = $notification;
            }
        }

        return $notifications;
    }

    public function getNotificationsByTypes(array $types): array
    {
        $notifications = [];

        foreach ($this->notifications as $notification) {
            if (in_array($notification->getType(), $types)) {
                $notifications[] = $notification;
            }
        }

        return $notifications;
    }
}
