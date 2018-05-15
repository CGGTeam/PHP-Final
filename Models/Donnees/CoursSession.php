<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 05/04/18
 * Time: 18:21
 */
    
    class CoursSession extends ModelBinding {
    
        /** @var string $session No de la session (A-2099; H-2018 à A-2021) */
    public $session;
    /** @var string $sigle Sigle du cours (999-ZZZ; ADM-A99) */
    public $sigle;
    /** @var int $utilisateur id de l'utilisateur */
    public $utilisateur;
    
    public function __construct(array $properties = array(), $binAjout = false) {
        parent::__construct($properties, $binAjout);
    }

        public function valider() {
            try {
                $this->utilisateur = intval($this->utilisateur);
            $binValide = validerSession($this->session) && validerSigle($this->sigle) && is_int($this->utilisateur);
                $this->utilisateur = intval($this->utilisateur);
            if (!$binValide)
                $this->setIntModelState(ModelState::Invalid);
            return $binValide;
            } catch (Exception $e) {
                $this->setIntModelState(ModelState::Invalid);
                return false;
            }

        }
}