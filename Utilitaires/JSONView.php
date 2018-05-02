<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 10:36 PM
     */
    
    class JSONView extends View {
        public function __construct($model = null) {
            log_fichier("hello");
            parent::__construct($model);
        }
        
        public function afficher() {
            log_fichier("wtf");
            ob_end_clean();
            header('Content-Type: application/json');
            echo $this->model;
        }
    }