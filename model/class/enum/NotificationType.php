<?php

enum NotificationType
{
    const FRIEND_REQUEST = 1;
    const FRIEND_REQUEST_ACCEPTED = 2;
    const FRIEND_REQUEST_DECLINED = 3;
    const MESSAGE_PINNED = 4;
    const MESSAGE_UNPINNED = 5;
    const MESSAGE_LIKED = 6;
    const REMOVED_FROM_GROUP = 8;
    const GROUP_INVITATION = 9;
    const GROUP_INVITATION_ACCEPTED = 10;
    const GROUP_INVITATION_DECLINED = 11;
    const MENTIONNED_IN_MESSAGE = 12;

    const FRIENDS = [NotificationType::FRIEND_REQUEST, NotificationType::FRIEND_REQUEST_ACCEPTED, NotificationType::FRIEND_REQUEST_DECLINED];
    const MESSAGES = [NotificationType::MESSAGE_PINNED, NotificationType::MESSAGE_UNPINNED, NotificationType::MESSAGE_LIKED];
    const GROUPS = [NotificationType::REMOVED_FROM_GROUP, NotificationType::GROUP_INVITATION, NotificationType::GROUP_INVITATION_ACCEPTED, NotificationType::GROUP_INVITATION_DECLINED];
}
