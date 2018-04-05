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
    class Categorie extends ModelBinding
    {
        //Champs de la table
        public $id;
        public $description;

        public function __construct(array $properties = array())
        {
            parent::__construct($properties);
        }
    }