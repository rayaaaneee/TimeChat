<?php

require_once(PATH_APPS . 'saveImage.php');
class User
{

    private string $username;
    private string $password;
    private ?string $description;
    private ?int $id;
    private ?bool $isPublic;
    private string $profilePicture;
    private string $banner;
    private ?DateTime $signupAt;
    private UserDAO $userDAO;
    private UserDTO $userDTO;

    public function __construct(string $username, string $password, string $description = null,  string $profilePicture = "default.png", bool $isPublic = null, string $banner = 'default.png', DateTime $signupAt = null, int $id = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->description = $description;
        $this->isPublic = $isPublic;
        $this->profilePicture = $profilePicture;
        $this->banner = $banner;
        $this->signupAt = $signupAt;
        $this->id = $id;
        $this->userDAO = new UserDAO();
        $this->userDTO = new UserDTO();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function signin(): ?array
    {
        return $this->userDAO->signin($this);
    }

    public function signup(): string
    {
        if ($this->profilePicture != "default.png") {
            $errorFile = saveImage($this->username, PATH_PROFILE_PICTURES);
            if ($errorFile[0] == 1) {
                $this->profilePicture = $errorFile[2];
            } else {
                Header("Location: ?page=signup&upload=" . $errorFile[1]);
                exit();
            }
        }
        $message = $this->userDTO->signup($this);
        return $message;
    }

    public function signout(): void
    {
        $this->userDAO->signout();
    }

    public static function signedOut($user): void
    {
        if (isset($_POST['signout'])) {
            $user->signout();
        }
    }

    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }

    public function getProfilePicturePath(): string
    {
        if ($this->profilePicture == "default.png") {
            return PATH_PROFILE_PICTURES . "default/" . $this->profilePicture;
        } else {
            return PATH_PROFILE_PICTURES . $this->profilePicture;
        }
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function getBannerPath(): string
    {
        $files = scandir(PATH_BANNERS . "default/");
        if (in_array($this->banner, $files)) {
            return PATH_BANNERS . "default/" . $this->banner;
        } else {
            return PATH_BANNERS . $this->banner;
        }
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function getSignupAt(): DateTime
    {
        return $this->signupAt;
    }

    public function formatSignupAt(): string
    {
        return $this->signupAt->format('d/m/Y');
    }

    public function isDefaultProfilePicture(): bool
    {
        return $this->profilePicture == "default.png";
    }
}
