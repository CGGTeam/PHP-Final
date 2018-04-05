<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:18 AM
     */
    
    /**
     * Class Categorie modèle qui représente une catégorie
     */
    class Categorie
    {
        public $description;
    
        /**
         * Categorie constructor.
         * @param string $strDescription - Nom de la catégorie
         */
        function __construct($strDescription) {
            $this->description = $strDescription;
        }
    }