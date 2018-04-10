<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditDocumentsController extends ModuleAdminBase
    {
        function __construct() {
            parent::__construct();
        }
    
        function EditDocuments()
        {
            return new View();
        }
        function selection()
        {
            header('Location: ?controller=Login&action=CreerAdmin');
            return View("", 301);
        }
    }