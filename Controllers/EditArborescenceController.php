<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:44 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditArborescenceController extends ModuleAdminBase
    {
        function __construct() {
            parent::__construct();
        }
    
        function EditArborescence()
        {
            $GLOBALS["titrePage"] = "Arborescence des documents";
            return new View();
        }
        function nettoyage()
        {
            $GLOBALS["titrePage"] = "Nettoyage de l'arborescence";
            return new View();
        }
    }