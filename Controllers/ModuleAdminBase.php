<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 3:44 PM
     */
    
    abstract class ModuleAdminBase {
        function __construct() {
            if(!isset($_SESSION))
            {
                session_start();
            }
            global $authorized;
            $authorized = $_SESSION["utilisateurCourant"] && $_SESSION["utilisateurCourant"]->statutAdmin;
        }
    }