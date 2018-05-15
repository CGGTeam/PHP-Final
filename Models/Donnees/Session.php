<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:45 AM
     */
    
    /**
     * Class Session modèle qui représente une session
     */
    class Session extends ModelBinding {
        /** @var string $description No de la session (A-2099; H-2018 à A-2021) */
        public $description;
        /** @var string $dateDebut Date de début de la session */
        public $dateDebut;
        /** @var string $dateFin Date de fin de la session */
        public $dateFin;
    
        public function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties, $binAjout);
        }
        
        public function valider() {
            if (!validerSession($this->description) || !dateValide($this->dateDebut) || !dateValide($this->dateFin)) {
                $this->setIntModelState(ModelState::Invalid);
                return false;
            }
    
            if (!validerDateSession($this->dateDebut, "2018-01-01", $this->dateFin) ||
                !validerDateSession($this->dateFin, $this->dateDebut)) {
                $this->setIntModelState(ModelState::Invalid);
                return false;
            }
    
            return true;
        }
    }