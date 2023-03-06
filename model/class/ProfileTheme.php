<?php

require_once(PATH_DTO . 'ProfileThemeDTO.php');

class ProfileTheme
{
    public static string $defaultTheme = 'red';
    private int $userid;
    private string $theme;
    private ?string $banner;

    public function __construct(string $theme, ?string $banner, int $userId = null)
    {
        $this->banner = $banner;
        $this->theme = $theme;
        if ($userId != null) {
            $this->userid = $userId;
        }
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function getBannerPath(): string
    {
        return PATH_BANNERS . $this->banner;
    }

    public function getUserId(): int
    {
        return $this->userid;
    }

    public function setUserId(int $userId): void
    {
        $this->userid = $userId;
    }
}
