<?php

use Dasha\application\controller\Chat_Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Dasha\application\repository\ArchiveMes_Repository;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/src/application/view/');
$twig = new Environment($loader);

$recordsRepository = new ArchiveMes_Repository();
$chat = new Chat_Controller($twig);

const SITE_URL = 'http://134.122.61.224/:1212/';
$uri = $_SERVER['REQUEST_URI'];
$chat->__invokeAuth();


$login = $_POST['login'];
$password = $_POST['password'];

//$chars = ['.']; // символы для удаления
//$ip = str_replace($chars,'', $ip_);

if ($login != '' && $password != '') {
    switch ($uri) {
        // начальная загрузка
        //case '/': {
        //     $chat->__invokeAuth();
        //    break;
        // }

        case '/auth': {
                $recordsRepository->_authorizeUser($login, $password);
            break;
        }

        case '/register': {
                $recordsRepository->_registrationUser($login, $password);
                //header('Location: ' .$this->SITE_URL. 'tupen/');
            break;
        }
    }
}


?>