<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    require_once("Controllers/ModuleAdminBase.php");
    
    class EditReferencesController extends ModuleAdminBase
    {
        function __construct() {
            require_once "Models/EditReferences/EnumEtatsReferences.php";
            require_once "Models/EditReferences/ReferencesModel.php";
            require_once "Utilitaires/ModelBinding.php";
            require_once "Utilitaires/View.php";
            require_once "Models/Donnees/Categorie.php";
            require_once "Models/Donnees/Cours.php";
            require_once "Models/Donnees/CoursSession.php";
            require_once "Models/Donnees/Document.php";
            require_once "Models/Donnees/Session.php";
            require_once "Models/Donnees/Utilisateur.php";
            parent::__construct();
        }
    
        function EditReferences()
        {
            return new View();
        }
    
        function AfficherSessions()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Session");
            $tSessions = ModelBinding::bindToClass($objRetour, "Session");
    
            return new View(new ReferencesModel($tSessions, EnumEtatsReferences::EDIT));
        }
    
        function ConfirmerSessions() {
            $strDonnees = post("donneesSession");
            $tSessionsJson = json_decode($strDonnees, true);
            $tSessionsObj = array();
            foreach ($tSessionsJson as $sj) {
                $so = new Session($sj);
                $tSessionsObj[] = $so;
                $so->saveChangesOnObj();
            }
        
            header('Location: ?controller=EditReferences&action=AfficherSessions');
            return new View("", 301);
        }
    
        function AfficherCours()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Cours");
            $tCours = ModelBinding::bindToClass($objRetour, "Cours");
    
            return new View(new ReferencesModel($tCours), EnumEtatsReferences::EDIT);
        }
    
        function ConfirmerCours()
        {
            $strDonnees = post("donneesCours");
            $tCoursJson = json_decode($strDonnees, true);
            $tCoursObj = array();
            foreach ($tCoursJson as $cj) {
                $co = new Cours($cj);
                $tCoursObj[] = $co;
                $co->saveChangesOnObj();
            }
    
            header('Location: ?controller=EditReferences&action=AfficherCours');
            return new View("", 301);
        }
    
        function AfficherCoursSessions()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("CoursSession");
            $tCoursSessions = ModelBinding::bindToClass($objRetour, "CoursSession");
    
            return new View(new ReferencesModel($tCoursSessions), EnumEtatsReferences::EDIT);
        }
    
        function ConfirmerCoursSessions()
        {
            $strDonnees = post("donneesCoursSessions");
            $tCoursSessionsJson = json_decode($strDonnees, true);
            $tCoursSessionsObj = array();
            foreach ($tCoursSessionsJson as $csj) {
                $cso = new Cours($csj);
                $tCoursSessionsObj[] = $cso;
                $cso->saveChangesOnObj();
            }
    
            header('Location: ?controller=EditReferences&action=AfficherCoursSessions');
            return new View("", 301);
        }
    
        function AfficherCategories()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Categorie");
            $tCategories = ModelBinding::bindToClass($objRetour, "Categorie");
    
            return new View(new ReferencesModel($tCategories), EnumEtatsReferences::EDIT);
        }
    
        function ConfirmerCategories()
        {
            $strDonnees = post("donneesCategories");
            $tCategoriesJson = json_decode($strDonnees, true);
            $tCategoriesObj = array();
            foreach ($tCategoriesJson as $cj) {
                $co = new Categorie($cj);
                $tCategoriesObj[] = $co;
                $co->getModelState();
            }
    
            header('Location: ?controller=EditReferences&action=AfficherCategories');
            return new View("", 301);
        }
    
        function AfficherUtilisateurs()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Utilisateur");
            $tUtilisateurs = ModelBinding::bindToClass($objRetour, "Utilisateur");
    
            return new View(new ReferencesModel($tUtilisateurs), EnumEtatsReferences::EDIT);
        }
    
        function ConfirmerUtilisateurs()
        {
            $strDonnees = post("donneesUtilisateurs");
            $tUtilisateursJson = json_decode($strDonnees, true);
            $tUtilisateursObj = array();
            foreach ($tUtilisateursJson as $uj) {
                $uo = new Categorie($uj);
                $tUtilisateursObj[] = $uo;
                $uo->getModelState();
            }
    
            header('Location: ?controller=EditReferences&action=AfficherUtilisateurs');
            return new View("", 301);
        }
    }