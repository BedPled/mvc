<?php

namespace src\application\model;

use PDO;
use src\application\ArchiveMes;

class ArchiveMes_Model
{
    private $connection;
    private $records;
    const SITE_URL = 'http://134.122.61.224/:1212/';

    private $sault = 'mSD6PeopFxQSolU';

    public function __construct()
    {
        $user = 'back';
        $password = '12345';
        $db = 'mvc';
        $host = 'localhost';
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        } catch (PDOException $e) {
            echo " не соединено с БД";
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public function Authentication($records) {
        $login = $records->getLogin();
        $password = $records->getPass();

        $hash_pass = md5($password . $this->sault);

        $sql = "SELECT * from messArchive_Auth WHERE username = :login and password = :password and hash = :hash_pass";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('login', $login);
        $stmt->bindParam('password', $password);
        $stmt->bindParam('hash_pass', $hash_pass);
        $stmt->execute();

        $stmt = $stmt->fetchAll();

        if (count($stmt) > 0) {
            setcookie('login', $login, time() + 180);
            header('Location: ' .$this->SITE_URL. '/test?');
        }
        else 
            echo 'Логин или пароль не верный или пользователь не существует';
    }

    public function Registration($records) {

        foreach ($records as $element) {
            $login = $element->getLogin();
            $password = $element->getPass();

            $sql = "SELECT * FROM messArchive_Auth WHERE username = :login";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam('login', $login, PDO::PARAM_STR);
            $stmt->execute();

            $stmt = $stmt->fetchAll();

            if (count($stmt) > 0) {
                echo 'Пользователь с таким логином уже существует';
            }
            else
            {
                $hash_pass = md5($password . $this->sault);
                $sql = "INSERT INTO messArchive_Auth values('$login', '$password', '$hash_pass')";
                $stmt1 = $this->connection->prepare($sql);

                $stmt1->execute();

                echo $login, $password, $hash_pass;
                //setcookie('login_reg', $login, time() + 180);
                //header('Location: ' . $this->SITE_URL. '/like');
            }
        }
    }
    
}