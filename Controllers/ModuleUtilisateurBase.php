<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-10
     * Time: 1:32 PM
     */
    
    abstract class ModuleUtilisateurBase {
        function __construct() {
            global $authorized;
            $authorized = isset($_SESSION["utilisateurCourant"]) && !$_SESSION["utilisateurCourant"]->statuAdmin;
        }
    }