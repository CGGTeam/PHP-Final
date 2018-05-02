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
        function __construct() {
            parent::__construct();
        }
        
        function EditGroupes()
        {
            $GLOBALS["titrePage"] = "Modification des groupes";
    
            if (isset($_FILES["fichierCSV"])) {
                $tcontenu = preg_split("/\r\n|\r|\n/", file_get_contents($_FILES["fichierCSV"]));
                foreach ($tcontenu as $ligne) {
                    $tChamps = $tcontenu;
                }
            }
            return new View();
        }
        
        function lireCSV()
        {
            $GLOBALS["titrePage"] = "Lecture du csv";
            return new View();
        }
        
        function confirmer()
        {
            $GLOBALS["titrePage"] = "Modification des groupes";
            return new View();
        }
    }