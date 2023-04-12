<?php

class User
{
    public $username;
    public $password;
    public $isAdmin;

    public function __construct($username, $password, $isAdmin) {
        $this->username = $username;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }
}