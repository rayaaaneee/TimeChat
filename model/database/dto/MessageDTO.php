<?php

require_once(PATH_DATABASE . 'DTO.php');

class MessageDTO extends DTO
{
    private static string $table = 'message';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertMessage(string $message, int $userId, int $chatId): bool
    {
        $data = [
            'message' => $message,
            'user_id' => $userId,
            'chat_id' => $chatId
        ];
        return $this->insert('messages', $data);
    }

    public function getMessagesByChatId(int $chatId): array
    {
        $sql = 'SELECT * FROM messages WHERE chat_id = :chat_id';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':chat_id', $chatId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
