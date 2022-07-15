<?php

namespace src\application;

class ArchiveMes
{
    private $login;
    private $password;

    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
    }
    
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPass()
    {
        return $this->password;
    }

    public function setPass($password)
    {
        $this->password = $password;
    }
}