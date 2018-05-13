<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 10:36 PM
     */
    require_once "Utilitaires/iRetour.php";

    class JSONView implements iRetour {
        private $model;

        public function __construct($model = null) {
            log_fichier("aaaa");
            $this->model = $model;
        }
        
        public function afficher() {
            log_fichier($this->model);
            ob_end_clean();
            log_fichier('cleaned');
            header('Content-Type: application/json');
            log_fichier('set header');
            echo $this->model;
            log_fichier('echo fait');
        }
    }