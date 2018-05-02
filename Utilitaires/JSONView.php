<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-01
     * Time: 10:36 PM
     */
    
    class JSONView extends View {
        public function __construct($model = null) {
            parent::__construct($model);
        }
        
        public function afficher() {
            header('Content-Type: application/json');
            ob_end_clean();
            echo $this->model;
        }
    }