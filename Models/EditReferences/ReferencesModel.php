<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 1:34 PM
     */
    
    class ReferencesModel {
        /**@var int $etat nombre correspondant à un état dans enumEtatsReferences.php */
        public $etat;
        /** @var array $donnees tableaux des données à afficher */
        public $donnees;
        /** @var string $type La classe utilisée */
        public $type;
        
        /**
         * ReferencesModel constructor.
         * @param array $donnees tableaux des données à afficher
         * @param string $type La classe utilisée
         * @param int $etat nombre correspondant à un état dans enumEtatsReferences.php
         */
        function __construct($donnees, $type, $etat = 0) {
            $this->etat = $etat;
            $this->donnees = $donnees;
            $this->type = $type;
        }
    }