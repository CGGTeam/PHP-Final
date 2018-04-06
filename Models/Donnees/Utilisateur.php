<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:49 AM
     */
    
    /**
     * Class Utilisateur modèle qui représente l'utilisateur
     */
    class Utilisateur extends ModelBinding
    {
        public static $utilisateurCourant;
        public $id;
        public $nomUtilisateur;
        public $motDePasse;
        public $statutAdmin;
        public $nomComplet;
        public $courriel;
    
        public function __construct(array $properties = array(), $binAjout = false)
        {
            parent::__construct($properties, $binAjout);
        }
    }