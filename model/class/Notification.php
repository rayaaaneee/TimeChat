<?php

require_once(PATH_ENUMS . 'NotificationType.php');

class Notification
{
    private int $idUserSender;
    private int $idUserReceiver;
    private int $type;
    private \DateTime $date;
    private ?int $id = null;
    private User $userSender;
    private bool $isRead = false;

    public function __construct(int $idUserSender, int $idUserReceiver, ?int $type = null, \DateTime $date = new \DateTime("now", new \DateTimeZone("Europe/Paris")), ?int $id = null)
    {
        $this->idUserSender = $idUserSender;
        $this->idUserReceiver = $idUserReceiver;
        $this->date = $date;

        if ($type != null) {
            $this->type = $type;
        }

        if ($id != null) {
            $this->id = $id;
        }
    }

    public function setIsRead(bool $isRead)
    {
        $this->isRead = $isRead;
    }

    public function getIdUserSender(): int
    {
        return $this->idUserSender;
    }

    public function getIdUserReceiver(): int
    {
        return $this->idUserReceiver;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserSender(User $userSender)
    {
        $this->userSender = $userSender;
    }

    public function getUserSender(): User
    {
        return $this->userSender;
    }

    public function getTextDate(): string
    {

        $now = new \DateTime("now", new \DateTimeZone("Europe/Paris"));

        $diff = $this->date->diff($now);

        $result = '';
        if ($diff->y > 0) {
            $result = $diff->y . ' year' . ($diff->y > 1 ? 's' : '');
        } else if ($diff->m > 0) {
            $result = $diff->m . ' month';
        } else if ($diff->d > 0) {
            $result = $diff->d . ' day' . ($diff->d > 1 ? 's' : '');
        } else if ($diff->h > 0) {
            $result = $diff->h . ' hour' . ($diff->h > 1 ? 's' : '');
        } else if (59 - $diff->i > 0) {
            $result = 59 - $diff->i . ' minute' . (59 - $diff->i > 1 ? 's' : '');
        } else {
            return 'just now';
        }

        return $result . ' ago';
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }
}
