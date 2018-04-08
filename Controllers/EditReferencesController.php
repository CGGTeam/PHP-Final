lol
<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    class EditReferencesController
    {
        function editReferences()
        {
            return new View();
        }
    
        function afficherSessions()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Session");
            $tSessions = ModelBinding::bindToClass($objRetour, "Session");
    
            return new View($tSessions);
        }
    
        function confirmerSessions() {
            $strDonnees = post("donneesSession");
            $tSessionsJson = json_decode($strDonnees, true);
            $tSessionsObj = array();
            foreach ($tSessionsJson as $sj) {
                $so = new Session($sj);
                $tSessionsObj[] = $so;
                $so->saveChangesOnObj();
            }
        
            return new View($tSessionsObj, "Views/EditReferences/AfficherSessionsView.php");
        }
    
        function afficherCours()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Cours");
            $tCours = ModelBinding::bindToClass($objRetour, "Cours");
    
            return new View($tCours);
        }
    
        function confirmerCours()
        {
            $strDonnees = post("donneesCours");
            $tCoursJson = json_decode($strDonnees, true);
            $tCoursObj = array();
            foreach ($tCoursJson as $cj) {
                $co = new Cours($cj);
                $tCoursObj[] = $co;
                $co->saveChangesOnObj();
            }
    
            return new View($tCoursObj, "Views/EditReferences/AfficherCoursView.php");
        }
    
        function afficherCoursSessions()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("CoursSession");
            $tCoursSessions = ModelBinding::bindToClass($objRetour, "CoursSession");
    
    
            return new View($tCoursSessions);
        }
    
        function confirmerCoursSessions()
        {
            $strDonnees = post("donneesCoursSessions");
            $tCoursSessionsJson = json_decode($strDonnees, true);
            $tCoursSessionsObj = array();
            foreach ($tCoursSessionsJson as $csj) {
                $cso = new Cours($csj);
                $tCoursSessionsObj[] = $cso;
                $cso->saveChangesOnObj();
            }
    
            return new View($tCoursSessionsObj, "Views/EditReferences/AfficherCoursSessionsView.php");
        }
    
        function afficherCategories()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Categorie");
            $tCategories = ModelBinding::bindToClass($objRetour, "Categorie");
    
            return new View($tCategories);
        }
    
        function confirmerCategories()
        {
            $strDonnees = post("donneesCategories");
            $tCategoriesJson = json_decode($strDonnees, true);
            $tCategoriesObj = array();
            foreach ($tCategoriesJson as $cj) {
                $co = new Categorie($cj);
                $tCategoriesObj[] = $co;
                $co->getModelState();
            }
    
            return new View($tCategoriesObj, "Views/EditReferences/AfficherCategoriesView.php");
        }
    
        function afficherUtilisateurs()
        {
            global $bd;
            $objRetour = $bd->selectionneRow("Utilisateur");
            $tUtilisateurs = ModelBinding::bindToClass($objRetour, "Utilisateur");
    
            return new View($tUtilisateurs);
        }
    
        function confirmerUtilisateurs()
        {
            $strDonnees = post("donneesUtilisateurs");
            $tUtilisateursJson = json_decode($strDonnees, true);
            $tUtilisateursObj = array();
            foreach ($tUtilisateursJson as $uj) {
                $uo = new Categorie($uj);
                $tUtilisateursObj[] = $uo;
                $uo->getModelState();
            }
    
            return new View($tUtilisateursObj, "Views/EditReferences/AfficherUtilisateursView.php");
        }
    }