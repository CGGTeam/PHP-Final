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
        if(!$strChemin){
            $backtrace = debug_backtrace();
            $this->strChemin = preg_replace('/(Controllers)\\\(.*)(Controller.php)/', 'Views\\\$2\\' . $backtrace[1]['function'] . '.php',$backtrace[0]['file']);
        }
    }


    public function afficher(){
        $model = $this->model;
        require_once $this->strChemin;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }


}