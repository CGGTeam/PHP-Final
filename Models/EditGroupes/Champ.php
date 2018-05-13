<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-09
     * Time: 5:33 PM
     */
    
    class Champ {
        public $valeur;
        public $valide;
    
        function __construct($valeur, $valide = true, $raison = 4) {
            $this->valeur = $valeur;
            $this->valide = $valide;
            $this->raison = $raison;
        }
    }