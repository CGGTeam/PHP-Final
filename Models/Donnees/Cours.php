<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:24 AM
     */
    
    /**
     * Class Cours Modèle qui représente un Cours
     */
    class Cours extends ModelBinding
    {
        public $sigle;
        public $titre;
        public $nomProf;
    
        /**
         * Cours constructor.
         * @param string $strSigle - Sigle du cours (999-ZZZ; ADM-A99)
         * @param string $strTitre - Titre du cours
         * @param string $strNomProf - Nom et prénom du professeur
         */
        function __construct($strSigle, $strTitre, $strNomProf){
            $this->sigle = $strSigle;
            $this->titre = $strTitre;
            $this->nomProf = $strNomProf;
        }
    }