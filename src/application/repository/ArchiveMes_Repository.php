<?php

namespace src\application\repository;

use src\application\model\ArchiveMes_Model;
use src\application\ArchiveMes;

class ArchiveMes_Repository
{
    private $model;
    private $records = array();

    public function __construct()
    {
        $this->model = new ArchiveMes_Model();
    }
    
    public function _authorizeUser($login, $password)
    {
        $records = array();
        $element = new ArchiveMes($login, $password);
        $prr = $element->getLogin();

        echo $prr;

        array_push($records, $element);

        $records = new ArchiveMes($login, $password);
        $this->model->Authentication($records);
    }

    public function _registrationUser($login, $password) 
    {
        array_push($this->records, new ArchiveMes($login, $password));
        $this->model->Registration($this->records);
    }
}
