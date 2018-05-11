<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-11
     * Time: 12:32 PM
     */
    
    class FichierDoc {
        public $nomFichier;
        public $binDeleted;
        
        function __construct($nomFichier, $binDeleted) {
            $this->nomFichier = $nomFichier;
            $this->binDeleted = $binDeleted;
        }
    }