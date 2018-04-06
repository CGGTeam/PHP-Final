<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 04/04/18
 * Time: 19:09
 */

class View
{
    private $strChemin;
    private $model;

    public function __construct($model=null, $strChemin=null)
    {
        $this->model = $model;
        if(!$strChemin){
            $backtrace = debug_backtrace();
            $this->strChemin = preg_replace('/(Controllers)\\\(.*)(Controller.php)/', 'Views\\\$2\\' . $backtrace[1]['function'] . 'View.php', $backtrace[0]['file']);
        } else if (is_int($strChemin)) {
            http_response_code($strChemin);
        } else {
            $this->strChemin = $strChemin;
        }
    }


    public function afficher(){
        $model = $this->model;
        if(http_response_code() == 200) {
            require_once $this->strChemin;
        }else {
            echo "<h1>$model</h1>";
        }
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }


}