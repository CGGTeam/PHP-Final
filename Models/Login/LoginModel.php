<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-06
     * Time: 11:02 AM
     */
    
    class LoginModel
    {
        public $etat;
        
        /**
         * LoginModel constructor.
         * @param Utilisateur $utilisateur L'utilisateur, s'il y en a, qui s'est connecté
         * @param int $etat L'état de la tentative de connexion
         */
        function __construct($etat)
        {
            $this->etat = $etat;
        }
    }