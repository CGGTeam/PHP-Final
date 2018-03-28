<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 27/03/18
 * Time: 19:23
 */

class autresController
{
    public function erreur(){
        require_once "Views/Autres/Erreur.php";
    }

    public function test(){
        require_once "Views/Autres/Test.php";
    }
}