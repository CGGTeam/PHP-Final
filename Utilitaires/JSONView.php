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
            return $this->getModel();
        }
    }