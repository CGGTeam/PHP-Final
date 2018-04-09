<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditPrivilegesController extends ModuleAdminBase
    {
        function EditPrivileges()
        {
            return new View();
        }
        
        function enregistrerPrivileges()
        {
            header("Location: ");
            return new View("", 301);
        }
    }