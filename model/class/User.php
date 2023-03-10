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
    private ?string $qrcode = null;
    private ProfileTheme $profileTheme;
    private ?DateTime $signupAt;
    private UserDAO $userDAO;
    private UserDTO $userDTO;

    public function __construct(string $username, string $password, string $description = null,  string $profilePicture = "default.png", bool $isPublic = null, DateTime $signupAt = null, int $id = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->description = $description;
        $this->isPublic = $isPublic;
        $this->profilePicture = $profilePicture;
        $this->signupAt = $signupAt;
        $this->id = $id;
        $this->userDAO = new UserDAO();
        $this->userDTO = new UserDTO();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function updateUsername(string $username): string
    {
        if ($this->username === $username) {
            return "sames";
        } else {
            $this->username = $username;
            $message = $this->userDTO->updateUsername($username, $this->id);
            return $message;
        }
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function updatePassword(string $password): void
    {
        $this->password = $password;
        $this->userDTO->updatePassword($password, $this->id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getProfilePictureExtension(): string
    {
        return pathinfo(PATH_PROFILE_PICTURES . $this->profilePicture, PATHINFO_EXTENSION);
    }

    public function getBannerPath(): string
    {
        return $this->profileTheme->getBannerPath();
    }

    public function setProfileTheme(ProfileTheme $profileTheme): void
    {
        $this->profileTheme = $profileTheme;
    }

    public function getProfileTheme(): ProfileTheme
    {
        return $this->profileTheme;
    }

    public function getBackgroundColor(): string
    {
        return $this->profileTheme->getBackgroundColor();
    }

    public function getCornerColor(): string
    {
        return $this->profileTheme->getCornerColor();
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

    public function deleteAccount(): void
    {
        /* $this->userDAO->deleteAccount($this); */
    }

    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        }
        return false;
    }

    public function removeProfilePicture(): bool
    {
        $profilePicture = "default.png";
        $success = $this->userDTO->updateProfilePicture($profilePicture, $this);
        return $success;
    }

    public function updateProfile(string $newDescription, bool $newIsPublic, string $newProfilePicture): bool
    {
        if ($newProfilePicture != $this->profilePicture) {
            $errorFile = saveImage($this->username, PATH_PROFILE_PICTURES);
            if ($errorFile[0] != 1) {
                Header("Location: ?page=account&part=profile&upload=" . $errorFile[1]);
                exit();
            } else {
                $newProfilePicture = $errorFile[2];
            }
        }

        return $this->userDTO->updateProfile($this, $newDescription, $newIsPublic, $newProfilePicture);
    }

    public function getBanner(): string
    {
        return $this->profileTheme->getBanner();
    }

    public function setBanner(string $banner): void
    {
        $this->profileTheme->setBanner($banner);
    }

    public function getQRCode(): ?string
    {
        return $this->qrcode;
    }

    public function setQRCode(string $qrcode): void
    {
        $this->qrcode = $qrcode;
    }
}
