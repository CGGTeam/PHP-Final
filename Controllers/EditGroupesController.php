<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditGroupesController extends ModuleAdminBase
    {
        function EditGroupes()
        {
            return new View();
        }
        
        function lireCSV()
        {
            return new View();
        }
        
        function confirmer()
        {
            return new View();
        }
    }