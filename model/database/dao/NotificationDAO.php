<?php

require_once(PATH_DATABASE . 'DAO.php');
require_once(PATH_CLASSES . 'Notification.php');
require_once(PATH_ENUMS . 'NotificationType.php');

class NotificationDAO extends DAO
{
    public static string $table = 'notification';

    public function __construct()
    {
        parent::__construct();
    }

    public static function getNotificationsByUserReceiverId(int $idUserReceiver): array
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id_user_receiver = :id_user_receiver ORDER BY date DESC";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user_receiver', $idUserReceiver);

        $stmt->execute();

        $notifications = [];

        while ($row = $stmt->fetch()) {
            $notification = new Notification($row['id_user_sender'], $row['id_user_receiver'], $row['type'], new \DateTime($row['date']), $row['id']);

            $notifications[] = $notification;
        }

        return $notifications;
    }

    public function getCountNotificationsByUserReceiverId(int $idUserReceiver): int
    {
        $sql = "SELECT COUNT(*) FROM " . self::$table . " WHERE id_user_receiver = :id_user_receiver";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':id_user_receiver', $idUserReceiver);

        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
