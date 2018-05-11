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
    class Cours extends ModelBinding {
        /** @var string $sigle Sigle du cours (999-ZZZ; ADM-A99) */
        public $sigle;
        /** @var string $titre Titre du cours */
        public $titre;
        /** @var string $nomProf Nom et prénom du professeur */
        public $nomProf;
    
        function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties, $binAjout);
        }
    
        public function valider() {
            $binValide = validerSigle($this->sigle) && validerTitreCours($this->titre) && validerNomComplet($this->nomProf);
            if (!$binValide) {
                $this->setModelState(ModelState::Invalid);
            }
            return $binValide;
        }
    }