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
        function __construct() {
            parent::__construct();
        }
    
        function EditPrivileges()
        {
            $GLOBALS["titrePage"] = "Modification des privilèges";
            return new View();
        }
        
        function enregistrerPrivileges()
        {
            header("Location: ?controller=EditPrivileges&action=EditPrivileges");
            return new View("", 301);
        }
    }