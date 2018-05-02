<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-27
     * Time: 1:40 PM
     */
    
    class DocumentsCoursSession {
        /**
         * @var int $etat provient de EnumEtatsDocuments
         */
        public $etat;
        /**
         * @var Document[] $tDocuments
         */
        public $tDocuments;
        /**
         * @var int $intNbDocuments
         */
        public $intNbDocuments;
        
        /**
         * @param Document[] $tDocuments
         */
        function __construct($tDocuments, $etat = 0, $intNbDocuments = 0) {
            $this->tDocuments = $tDocuments;
            $this->etat = $etat;
            $this->intNbDocuments = $intNbDocuments;
        }
    }