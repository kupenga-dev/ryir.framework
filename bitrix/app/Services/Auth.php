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
            $username = $this->data['username'];
            $sault = [
                "$username" => "$hashSault",
            ];
            Config::addSault($sault);
            $hashPassword = md5($this->data['password'] . $hashSault);
            $arrayForUserCreation = array(
                'username' => $this->data['username'],
                'password' => $hashPassword,
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
        $sault = Config::get("saults/$username");
        if (md5($password . $sault) === $user['password']) {
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
        $valid = new Validator('regexp', '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/');
        $result = $valid->exec(htmlspecialchars($data['password']));
        if (!$result) {
            return false;
        }

        $valid = new Validator('regexp', "/^(?=^.{2,2}$)(?=.*[a-z][A-Z]).*$/i");
        $result = $valid->exec(htmlspecialchars($data['name']));
        if (!$result) {
            return false;
        }
        $valid = new Validator('email');
        $result = $valid->exec(htmlspecialchars($data['email']));
        if (!$result) {
            return false;
        }
        $valid = new Validator('minLength', 6);
        $result = $valid->exec(htmlspecialchars($data['username']));
        var_dump($result);
        if (!$result) {
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
