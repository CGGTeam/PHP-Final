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
        return new View();
    }
    
    /**
     *
     */
    public function test(){
        /* @var $result mysqli_result */
        $result = $GLOBALS['BD']->selectionneRow("tabletest");
        $strAAfficher = "";
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $strAAfficher .= "id: " . $row["id"]. " - value: " . $row["value"] . "<br>";
            }
        }
        $view = new View();
        return $view;
    }
}