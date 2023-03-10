<?php

require_once(PATH_ENUMS . 'NotificationType.php');

class Notification
{
    private int $idUserSender;
    private int $idUserReceiver;
    private int $notificationType;
    private \DateTime $date;

    public function __construct(int $idUserSender, int $idUserReceiver, ?int $notificationType = null, \DateTime $date = new \DateTime("now", new \DateTimeZone("Europe/Paris")))
    {
        $this->idUserSender = $idUserSender;
        $this->idUserReceiver = $idUserReceiver;
        $this->date = $date;

        if ($notificationType != null) {
            $this->notificationType = $notificationType;
        }
    }

    public function getIdUserSender(): int
    {
        return $this->idUserSender;
    }

    public function getIdUserReceiver(): int
    {
        return $this->idUserReceiver;
    }

    public function getNotificationType(): int
    {
        return $this->notificationType;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
