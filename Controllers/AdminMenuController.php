<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:33 AM
     */
    
    class AdminMenuController
    {
        function __construct()
        {
            //init
            require_once "Models/Donnees/Utilisateur.php";
            require_once "Utilitaires/ModelBinding.php";
        }
    
        function adminMenu()
        {
            echo "adminMenu";
            if (Utilisateur::$utilisateurCourant && Utilisateur::$utilisateurCourant->statutAdmin) {
                return new View();
            } else {
                return new View("403: Not Authorized", 403);
            }
        }
        
        /**
         * Mettre à jour la liste des documents
         *
         * Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer un ou plusieurs docu-ments.
         */
        function editDocuments()
        {
            return new View();
        }
        
        /**
         * Mettre à jour les tables de référence
         *
         * Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer une ou plusieurs ses-sions, cours,
         * catégories de document et/ou utilisateurs.
         */
        function editReferences()
        {
            return new View();
        }
        
        /**
         * Assigner les privilèges d'accès aux documents
         *
         * Cliquez sur le lien ci-dessus pour assigner les privilèges d'accès aux documents pour un ou plusieurs
         * utilisateurs.
         */
        function editPrivileges()
        {
            return new View();
        }
        
        /**
         * Assigner un groupe d'utilisateurs à un cours-session
         *
         * Cliquez sur le lien ci-dessus si vous désirez ajouter une série d'utilisateurs et les assigner à
         * cours-session existant.
         */
        function editGroupes()
        {
            return new View();
        }
        
        /**
         * Reconstruire l'arborescence des documents
         *
         * Cliquez sur le lien ci-dessus si vous désirez effectuer du ménage dans les listes de documents enregistrés.
         */
        function editArborescence()
        {
            return new View();
        }
        
        function quitter()
        {
            Utilisateur::$utilisateurCourant = null;
            return new View(EnumEtatsLogin::AUCUN_POST, "Views/Login/LoginView.php");
        }
    }