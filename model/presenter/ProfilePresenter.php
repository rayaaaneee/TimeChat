<?php

class ProfilePresenter
{
    public function formatUserIsPublicMyProfile($user): string
    {
        if ($user->isPublic()) {
            $tmp = "public";
        } else {
            $tmp = "private";
        }
        $HTML = '<img src="' . PATH_IMG_PAGES . 'myprofile/' . $tmp . '" alt="info-icon" draggable="false">';
        $HTML .= '<h1>Your profile is ' . $tmp . '</h1>';
        return $HTML;
    }

    public function printDescription($user): string
    {
        $HTML = "";
        if ($user->getDescription() == "") {
            $HTML = '<p class="content empty-desc">You have not set a description yet .</p>';
            $HTML .= '<a href="./?page=account" class="link-to-account">• Set a description</a>';
        } else {
            $HTML = '<p class="content"> • ' . $user->getDescription() . '</p>';
        }
        return $HTML;
    }

    public function formatUserIsPrivate(): string
    {
        $HTML = "";
        $HTML = '<img src="' . PATH_IMG_PAGES . 'myprofile/private.png" alt="info-icon" draggable="false">';
        $HTML .= '<h1>Your profile is private</h1>';
        return $HTML;
    }
}
