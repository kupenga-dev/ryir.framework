<?php

namespace App\Services;

use Ryir\Core\Router;
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
            $sault = Config::get('sault');
            $username = $this->data['username'];
            $hashPassword = crypt($this->data['password'], $sault);
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
        $sault = Config::get("sault");
        $hashPassword = crypt($password, $sault);
        if (hash_equals($hashPassword, $user['password'])) {
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
        Router::redirect('/');
    }

    private function isValidRegistration($data): bool
    {
        $map = [
            "name" => new Validator('regexp', '/^(?=^.{2,2}$)(?=.*[a-z][A-Z]).*$/i'),
            "password" => new Validator('regexp', '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'),
            "email" => new Validator('chain', true, [
                new Validator('email'),
                new Validator('callable', null, [
                    'class' => $this->databaseItem,
                    'method' => 'findUserByEmail',
                ]),
            ]),
            "username" => new Validator('chain', true, [
                new Validator('minLength', 6),
                new Validator('callable', null, [
                    'class' => $this->databaseItem,
                    'method' => 'findUserByUsername'
                ]),
            ]),
        ];

        foreach ($data as $key => $value) {
            if (!isset($map[$key])) {
                continue;
            }
            $valid = $map[$key];
            $result = $valid->exec(htmlspecialchars($value));
            if (!$result) {
                return false;
            }
        }

        if (htmlspecialchars($data['password']) !== htmlspecialchars($data['confirn_password'])) {
            return false;
        }

        return true;
    }
}
