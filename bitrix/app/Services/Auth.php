<?php

namespace App\Services;

use Ryir\Core\Validator;

class Auth
{
    private $databaseItem;
    private $data;


    public function __construct($data)
    {
        $this->databaseItem = new Database;
        $this->data = $data;
    }

    public function register(): bool
    {
        if ($this->isValidRegistration($this->data)) {
            $sault = $this->GenerateRandomString();
            $hashSault = md5($sault);
            $hashPassword = md5($this->data['password'] . $hashSault);
            $arrayForUserCreation = array(
                'username' => $this->data['username'],
                'password' => $hashPassword,
                'sault' => $hashSault,
                'email' => $this->data['email'],
                'name' => $this->data['name']
            );
            $this->databaseItem->createUser($arrayForUserCreation);
            return true;
        }
        return false;
    }

    public function auth(): bool
    {
        $username = $this->data['username'];
        $password = $this->data['password'];
        $user = $this->databaseItem->findUserByUsername($username, true);
        if (!$user) {
            return 'Неверный логин';
        }
        if ($user && md5($password . $user['sault']) === $user['password']) {
            setcookie($user['name'], $user['username'], time() + 3600);
            $_SESSION['user'] = [
                "username" => $user['username'],
                "name" => $user['name']
            ];
        }
        return true;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        \Ryir\Core\Router::redirect('/');
    }

    private function isValidRegistration($data): bool
    {
        $valid = new Validator('chain', 'true', [
            new Validator('isEmpty'),
            new Validator('regexp', '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'),
        ]);
        $valid->exec(htmlspecialchars($data['password']));
        if (!$valid) {
            return false;
        }

        $valid = new Validator('chain', 'true', [
            new Validator('isEmpty'),
            new Validator('regexp', "/^[a-zA-Z]{2, 2}+$/"),
        ]);
        $valid->exec(htmlspecialchars($data['name']));
        if (!$valid) {
            return false;
        }

        $valid = new Validator('chain', 'true', [
            new Validator('isEmpty'),
            new Validator('email'),
        ]);
        $valid->exec(htmlspecialchars($data['email']));
        if (!$valid) {
            return false;
        }

        $valid = new Validator('chain', 'true', [
            new Validator('isEmpty'),
            new Validator('minLength', 6),
        ]);
        $valid->exec(htmlspecialchars($data['username']));
        if (!$valid) {
            return false;
        }
        $valid = new Validator('isEmpty');
        $valid->exec(htmlspecialchars($data['confirn_password']));
        if (!$valid) {
            return false;
        }

        if (htmlspecialchars($data['password']) !== htmlspecialchars($data['confirn_password'])) {
            return false;
        }

        if ($this->databaseItem->findUserByUsername($data['username'])) {
            return false;
        }

        if ($this->databaseItem->findUserByEmail($data['email'])) {
            return false;
        }
        return true;
    }

    private function GenerateRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = mb_strlen($characters);
        $randomString = '';
        for ($i = 0; $i <= 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
