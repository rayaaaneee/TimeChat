<?php

require_once(PATH_CLASSES . "FriendRequest.php");

class FriendRequestManager
{
    private array $friendRequests = [];
    private FriendRequest $friendRequest;

    public function __construct($friendsRequests)
    {
        $this->friendRequests = $friendsRequests;
    }

    public function findByIdReceiver($id): ?FriendRequest
    {
        $result = null;
        foreach ($this->friendRequests as $friendRequest) {
            if ($friendRequest->getReceiverId() == $id) {
                $result = $friendRequest;
                $this->friendRequest = $friendRequest;
            }
        }
        return $result;
    }

    public function hasSendFriendRequest($id): bool
    {
        $res = $this->findByIdReceiver($id);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getFriendRequest(): FriendRequest
    {
        return $this->friendRequest;
    }
}
