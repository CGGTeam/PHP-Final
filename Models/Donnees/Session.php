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
    class Session extends ModelBinding
    {
        public $description;
        public $dateDebut;
        public $dateFin;

        public function __construct(array $properties = array(), $binAjout = false)
        {
            parent::__construct($properties, $binAjout);
        }
    }