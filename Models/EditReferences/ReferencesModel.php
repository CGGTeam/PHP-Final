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
        
        /**
         * ReferencesModel constructor.
         * @param array $donnees tableaux des données à afficher
         * @param int $etat nombre correspondant à un état dans enumEtatsReferences.php
         */
        function __construct($donnees, $etat = 0) {
            $this->etat = $etat;
            $this->donnees = $donnees;
        }
    }