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
    class Session
    {
        public $description;
        public $dateDebut;
        public $dateFin;
        /**
         * Session constructor.
         * @param string $strDescription - No de la session (A-2099; H-2018 à A-2021)
         * @param DateTime | string $dtDateDebut - Date de début de la session
         * @param DateTime | string $dtDateFin - Date de fin de la session
         */
        function __construct ($strDescription, $dtDateDebut, $dtDateFin) {
            $this->description = $strDescription;
            $this->dateDebut = $dtDateDebut;
            $this->dateFin = $dtDateFin;
        }
    }