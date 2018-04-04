<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-03
     * Time: 3:29 PM
     */
    
    class LoginController
    {
        function __construct()
        {
            //init
        }
        
        function login()
        {
            $strNomUtil = post("tbNomUtil");
            $strMotPasse = post("tbMotPasse");
            if ($strNomUtil && $strMotPasse) {
                /** @var mysql $BD */
                global $BD;
                $BD->requete();
            } else {
                require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Login/LoginView.php";
                return;
            }
        }
    }