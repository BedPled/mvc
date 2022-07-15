<?php
namespace src\application\controller;

use Twig\Environment;

class Chat_Controller
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeAuth()
    {
        echo $this->twig->render('auth.html.twig');
    }
}
