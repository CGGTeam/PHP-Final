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
        return new View('Not found', 404);
    }

    /**
     *
     */
    public function test(){
        /* @var $result mysqli_result */
        $result = $GLOBALS['BD']->selectionneRow("tabletest");
        $categories = ModelBinding::bindToClass($result,'Categorie');
        return new View($categories[0]);
    }
}