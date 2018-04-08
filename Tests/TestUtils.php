<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-08
     * Time: 3:10 PM
     */
    
    /**
     * @param array[string]json $posts associative array containing post names and related json strings
     */
    function makeJSONPosts($posts) {
        $_POST += $posts;
    }