<?php

namespace App\Services;

class Database
{
    private $users;

    public function __construct()
    {
        if (file_exists(__DIR__ . '/database.json')) {
            $this->users = json_decode(file_get_contents(__DIR__ . '/database.json'), true);
        } else {
            $this->users = null;
        }
    }

    public function findUserByUsername($username, $data = false)
    {
        foreach ($this->users as $user) {
            if ($user['username'] === $username) {
                if ($data === true) {
                    return $user;
                }
                return true;
            }
        }
        return false;
    }

    public function findUserByEmail($email)
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return true;
            }
        }
        return false;
    }

    public function createUser($data)
    {
        $this->users[] = $data;
        $this->putJson($this->users);
    }

    public function update_user($data, $username)
    {
        $updateUser = [];

        $users = getUsers();
        foreach ($this->users as $i => $user) {
            if ($user['username'] == $username) {
                $this->users[$i] = $updateUser = array_merge($user, $data);
            }
        }
        $this->putJson($this->users);
    }

    public function delete_user()
    {

        foreach ($this->users as $i => $user) {
            if ($user['id'] == $id) {
                array_splice($this->users, $i, 1);
            }
        }

        $this->putJson($this->users);
    }

    private function putJson($user)
    {
        file_put_contents(__DIR__ . '/database.json', json_encode($user, JSON_PRETTY_PRINT));
    }
}
