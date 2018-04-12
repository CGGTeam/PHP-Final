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
        /** @var int $id */
        public $id;
        /** @var string $description nom de la catégorie */
        public $description;
    
        public function __construct(array $properties = array(), $binAjout = false)
        {
            parent::__construct($properties);
        }
    }