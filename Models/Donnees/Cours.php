<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:24 AM
     */
    
    /**
     * Class Cours Modèle qui représente un Cours
     */
    class Cours extends ModelBinding
    {
        public $sigle;
        public $titre;
        public $nomProf;
    
        function __construct(array $properties = array(), $binAjout = false) {
            parent::__construct($properties, $binAjout);
        }
    }