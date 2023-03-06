<?php

require_once(PATH_DTO . 'ProfileThemeDTO.php');

class ProfileTheme
{
    public static string $defaultTheme = 'red';
    private string $theme;
    private string $banner;
    private int $userid;

    private ProfileThemeDTO $profileThemeDTO;

    public function __construct(string $theme, ?string $banner)
    {
        $this->profileThemeDTO = new ProfileThemeDTO();
        $this->banner = $banner;
        $this->theme = $theme;
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
