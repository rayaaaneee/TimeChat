<?php

class Theme
{
    private string $name;
    private string $backgroundColor;
    private string $bannerName;

    public function __construct(string $name, string $backgroundColor, string $bannerName)
    {
        $this->name = $name;
        $this->backgroundColor = $backgroundColor;
        $this->bannerName = $bannerName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function getBannerName(): string
    {
        return $this->bannerName;
    }

    public function getBannerPath(): string
    {
        return PATH_IMG . 'upload/banner/default/' . $this->bannerName;
    }
}
