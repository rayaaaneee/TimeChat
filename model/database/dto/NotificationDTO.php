<?php

require_once(PATH_CLASSES . 'Notification.php');
require_once(PATH_DATABASE . 'DTO.php');

class NotificationDTO extends DTO
{
    private static string $table = 'notification';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOne(Notification $notification): bool
    {
        $data = [
            'id_user_sender' => $notification->getIdUserSender(),
            'id_user_receiver' => $notification->getIdUserReceiver(),
            'type' => $notification->getNotificationType(),
            'date' => $notification->getDate()->format('Y-m-d H:i:s')
        ];

        return $this->insert(self::$table, $data);
    }

    public function removeOne(Notification $notification): bool
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id_user_sender = :id_user_sender AND id_user_receiver = :id_user_receiver AND type = :type";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user_sender', $notification->getIdUserSender());
        $stmt->bindValue(':id_user_receiver', $notification->getIdUserReceiver());
        $stmt->bindValue(':type', $notification->getNotificationType());

        $res = $stmt->execute();
        $count = $stmt->rowCount();
        return $res && $count > 0;
    }

    public function selectAllByIdUserReceiver(int $idUserReceiver): array
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id_user_receiver = :id_user_receiver";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user_receiver', $idUserReceiver);

        $stmt->execute();

        $notifications = [];

        while ($row = $stmt->fetch()) {
            $notification = new Notification($row['id_user_sender'], $row['id_user_receiver'], $row['notification_type'], new \DateTime($row['date']));

            array_push($notifications, $notification);
        }

        return $notifications;
    }

    public function selectAllByIdUserSender(int $idUserSender): array
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id_user_sender = :id_user_sender";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user_sender', $idUserSender);

        $stmt->execute();

        $notifications = [];

        while ($row = $stmt->fetch()) {
            $notification = new Notification($row['id_user_sender'], $row['id_user_receiver'], $row['notification_type'], new \DateTime($row['date']));

            array_push($notifications, $notification);
        }

        return $notifications;
    }
}
