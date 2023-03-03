<?php

class MyProfilePresenter
{
    public function formatUserIsPublic($user): string
    {
        if ($user->isPublic()) {
            $tmp = "public";
        } else {
            $tmp = "private";
        }
        $HTML = '<img src="' . PATH_IMG . 'myprofile/' . $tmp . '" alt="info-icon" draggable="false">';
        $HTML .= '<h1>Your profile is ' . $tmp . '</h1>';
        return $HTML;
    }

    public function printDescription($user): string
    {
        $HTML = "";
        if ($user->getDescription() == "") {
            $HTML = '<p class="content empty-desc">You have not set a description yet .</p>';
        } else {
            $HTML = '<p class="content"> • ' . $user->getDescription() . '</p>';
        }
        return $HTML;
    }
}
