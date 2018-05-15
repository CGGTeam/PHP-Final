<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-09
     * Time: 5:33 PM
     */
    require_once "./Models/EditGroupes/EnumRaisons.php";
    class Champ {
        public $valeur;
        public $valide;
    
        function __construct($valeur, $valide = true, $raison = EnumRaisons::VALIDE) {
            $this->valeur = $valeur;
            $this->valide = $valide;
            $this->raison = $raison;
        }
    }