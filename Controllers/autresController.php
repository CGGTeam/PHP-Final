<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 27/03/18
 * Time: 19:23
 */

class autresController
{
    private $bd;
    public function __construct()
    {
        /* @var $bd mysql */
        global $bd;
        $this->bd = $bd;
        global $authorized;
        $authorized = true;
    }

    public function erreur(){
        return new View('Not found', 404);
    }

    /**
     *
     */
    public function test(){
        $result = $this->bd->selectionneRow("tabletest");
        $categories = ModelBinding::bindToClass($result,'Categorie');
        return new View($categories[0] . "View");
    }
}