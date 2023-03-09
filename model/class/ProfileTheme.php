<?php

require_once(PATH_DTO . 'ProfileThemeDTO.php');

class ProfileTheme
{
    public static $defaultBanner = "default.png";
    public static string $defaultTheme = 'red';

    private int $userid;
    private string $theme;
    private ?string $banner;
    private ?string $backgroundColor;
    private ?string $cornerColor;
    private ?string $backgroundLock;

    public function __construct(string $theme, ?string $banner = null, string $backgroundColor = null, string $cornerColor = null, string $backgroundLock = null, ?int $userId = null)
    {
        $this->theme = $theme;
        $this->banner = $banner;
        $this->backgroundColor = $backgroundColor;
        $this->cornerColor = $cornerColor;
        $this->backgroundLock = $backgroundLock;

        if ($userId != null) {
            $this->userid = $userId;
        }
    }

    public function hasBanner(): bool
    {
        $themes = ManageThemes::getInstance()->getAllBanners();
        foreach ($themes as $theme) {
            if ($theme == $this->banner) {
                return false;
            }
        }
        return true;
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

    public function getBannerThemeFile(): string
    {
        $tmp = explode('.', $this->banner);
        if ($this->theme == self::$defaultTheme) {
            return $this->banner;
        }
        return $tmp[0] . '-' . strtolower($this->theme) . '.' . $tmp[1];
    }

    public function setBanner(string $banner): void
    {
        $this->banner = $banner;
    }

    public function getBannerPath(): string
    {
        if ($this->hasBanner()) {
            return PATH_BANNERS . $this->banner;
        } else {
            return $this->getDefaultBannerPath();
        }
    }

    public function getDefaultBannerPath(): string
    {
        if ($this->theme == self::$defaultTheme) {
            return PATH_BANNERS . 'default/' . self::$defaultBanner;
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

    public function getBackgroundLock(): ?string
    {
        return $this->backgroundLock;
    }
}
