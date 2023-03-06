<?php

require_once(PATH_DTO . 'ProfileThemeDTO.php');

class ProfileTheme
{
    public static string $defaultTheme = 'red';

    private int $userid;
    private string $theme;
    private ?string $banner;
    private ?string $backgroundColor;
    private ?string $cornerColor;

    public function __construct(string $theme, ?string $banner, string $backgroundColor = null, string $cornerColor = null, ?int $userId = null)
    {
        $this->theme = $theme;
        $this->banner = $banner;
        $this->backgroundColor = $backgroundColor;
        $this->cornerColor = $cornerColor;

        if ($userId != null) {
            $this->userid = $userId;
        }
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function getCornerColor(): string
    {
        return $this->cornerColor;
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
        if ($this->theme == self::$defaultTheme) {
            return PATH_BANNERS . 'default/default.png';
        } else {
            return PATH_BANNERS . 'default/default-' . strtolower($this->theme) . '.png';
        }
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
