<?php
    
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-05-13
     * Time: 11:03 PM
     */
    class EditArborescenceModel {
        public $verdict;
        public $lastIndex;
        
        function __construct($verdict, $lastIndex) {
            $this->verdict = $verdict;
            $this->lastIndex = $lastIndex;
        }
    }
    