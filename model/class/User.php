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
    private UserDAO $userDAO;
    private UserDTO $userDTO;

    public function __construct(string $username, string $password, string $description = null,  string $profilePicture = "default.png", bool $isPublic = null, int $id = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->description = $description;
        $this->isPublic = $isPublic;
        $this->profilePicture = $profilePicture;
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
        $message = $this->userDTO->signup($this);
        if ($message == 'success') {
            if ($this->profilePicture != "default.png") {
                if ($errorFile = saveImage($_FILES['file'], $this->username)) {
                    if ($errorFile[0] == 1) {
                        $this->profilePicture = $this->username . "." . strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                    } else {
                        return $errorFile;
                    }
                }
            }
        }
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}
