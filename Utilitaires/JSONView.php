<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 10:36 PM
     */
    
    class JSONView implements iRetour {
        private $model;
        
        public function __construct($model = null) {
            $this->model = $model;
        }
        
        public function afficher() {
            header('Content-Type: application/json');
            ob_end_clean();
            echo $this->model;
        }
    }