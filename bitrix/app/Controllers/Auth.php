<?php

namespace App\Controllers;

use App\Services\Router;
use App\Services\Database;

class Auth 
{
    private $databaseItem;
   

    public function __construct()
    {
        $this->databaseItem = new Database;
    }
    public function __destruct()
    {
        $this->databaseItem = NULL;
    }

    public function register()
    {   
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->isValidRegistration($data))
        {
            $sault = $this->GenerateRandomString();
            $hashSault = md5($sault);
            $hashPassword = md5($data['password'] . $hashSault);
            $arrayForUserCreation = array(
                'username' => $data['username'],
                'password' => $hashPassword,
                'sault' => $hashSault,
                'email' => $data['email'],
                'name' => $data['name']
            );
            $this->databaseItem->createUser($arrayForUserCreation);
            die();
        }
        return false;
    }

    public function auth()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data['username'];
        $password = $data['password'];
        $user = $this->databaseItem->findUserByUsername($username, true);
        if(!$user)
        {
            return 'Неверный логин';
        } elseif ($user && md5($password . $user['sault']) === $user['password'])
        {
            session_start();
            setcookie($user['name'], $user['username'], time()+3600);
            $_SESSION['user'] = [
                "username" => $user['username'],
                "name" => $user['name']
            ];
            die();
        } else {
            return 'Неверный пароль';
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        \App\Services\Router::redirect('/');
    }

    private function isValidRegistration($data)
    {
        $patternForPassword = '/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/';
        $patternForName = '/^[a-zA-Z]{2, 2}+$/';
        $patternForEmail = '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,10}$/';

        if (!empty($data['name']) || !empty($data['username']) || !empty($data['email']) || !empty($data['password']) || !empty($data['confirm_password']))
        {
            if (mb_strlen($data['username']) > 6 || preg_match($patternForName, $data['name']) || preg_match($patternForPassword, $data['password']) || preg_match($patternForEmail, $data['email']))
            {
                if(htmlspecialchars($data['password']) === htmlspecialchars($data['confirm_password']))
                {
                    if(!$this->databaseItem->findUserByUsername($data['username']))
                    {
                        if(!$this->databaseItem->findUserByEmail($data['email']))
                        {
                            return true;
                        }
                    }
                }
            }   
        }
        return false;
    }

    private function GenerateRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = mb_strlen($characters);
        $randomString = '';
        for ($i = 0; $i <= 8; $i++) 
        {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
