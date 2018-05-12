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
    class Utilisateur extends ModelBinding {
        /** @var int $id */
        public $id;
        /** @var string $nomUtilisateur Identifiant pour connexion */
        public $nomUtilisateur;
        /** @var string $motDePasse Mot de passe pour connexion */
        public $motDePasse;
        /** @var bool $statutAdmin true=Administrateur; false=Utilisateur */
        public $statutAdmin;
        /** @var string $nomComplet Nom et prénom de l’utilisateur */
        public $nomComplet;
        /** @var string $courriel Adresse de courriel permettant à l’utilisateur de récupérer son mot de passe à partir
         *                        de son nom d’utilisateur (saisie par l’administrateur).
         */
        public $courriel;
    
        public function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties, $binAjout);
            $this->statutAdmin = (bool) $this->statutAdmin;
        }
        
        public function valider() {
            $binValide = validerNomUtilisateur($this->nomUtilisateur, $this->getModelState() === ModelState::Deleted)
                && validerMotPasse($this->motDePasse)
                && is_bool($this->statutAdmin) && validerNomComplet($this->nomComplet);
            if (!$binValide)
                $this->setModelState(ModelState::Invalid);
            return $binValide;
        }
    }