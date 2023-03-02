<?php
class User
{

    private string $username;
    private string $password;
    private ?int $id;
    private UserDAO $userDAO;

    public function __construct(string $username, string $password, int $id = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->userDAO = new UserDAO();
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

    public function signup(): bool
    {
        return $this->userDAO->signup($this);
    }

    public function signout(): void
    {
        $this->userDAO->signout();
    }

    public static function signedOut(): void
    {
        if (isset($_POST['signout'])) {
            $user = new User('', '');
            $user->signout();
            header('Location: ./?page=signin');
        }
    }
}
