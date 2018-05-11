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
    class Categorie extends ModelBinding {
        /** @var int $id */
        public $id;
        /** @var string $description nom de la catégorie */
        public $description;
        
        public function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties);
        }
        
        public function valider() {
            $rexpCategorie = "/^[a-z]{3,}$/i";
            $binValide = preg_match($rexpCategorie, $this->description);
            if (!$binValide)
                $this->setModelState(ModelState::Invalid);
            return $binValide != false;
        }
    }