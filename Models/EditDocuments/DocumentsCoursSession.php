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
         * @var array $tCategories
         */
        public $tCategories;

        /**
         * @param Document[] $tDocuments
         * @param array $tCategorie
         * @param int $etat
         * @param int $intNbDocuments
         */
        function __construct($tDocuments, $tCategorie, $etat = 0, $intNbDocuments = 0) {
            $this->tDocuments = $tDocuments;
            $this->etat = $etat;
            $this->intNbDocuments = $intNbDocuments;
            $this->tCategories = $tCategorie;
        }
    }