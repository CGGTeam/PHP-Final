<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-27
     * Time: 1:45 PM
     */
    
    class SelectionDocumentModel {
        /**
         * @var int $nbDocuments nombre total de documents enregistrés pour tous les cours-sessions
         */
        public $nbDocuments;
        /**
         * @var CoursSession[] $tCoursSessions Liste des cours-sessions
         */
        public $tCoursSessions;
        
        /**
         * SelectionDocumentModel constructor.
         * @param int $nbDocuments nombre total de documents enregistrés pour tous les cours-sessions
         * @param CoursSession[] $tCoursSessions Liste des cours-sessions
         */
        public function __construct($nbDocuments, $tCoursSessions) {
            $this->nbDocuments = $nbDocuments;
            $this->tCoursSessions = $tCoursSessions;
        }
    }