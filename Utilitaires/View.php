<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 04/04/18
 * Time: 19:09
 */
    require_once "Utilitaires/iRetour.php";
    
    class View implements iRetour
{
    private $strChemin;
    protected $model;
    
    public function __construct($model = null, $strChemin = null, $binIsJson = false) {
        $this->model = $model;
        if(!$strChemin){
            $backtrace = debug_backtrace();
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $this->strChemin = preg_replace('/(Controllers)\\\(.*)(Controller.php)/', 'Views\\\$2\\' . $backtrace[1]['function'] . 'View.php', $backtrace[0]['file']);
            } else {
                $this->strChemin = preg_replace('/(Controllers)\/(.*)(Controller.php)/', 'Views/$2/' . $backtrace[1]['function'] . 'View.php', $backtrace[0]['file']);
            }
        } else if (is_int($strChemin)) {
            if ($strChemin == 418) {
                header("HTTP/1.0 418 I'm A Teapot");
            } else {
                http_response_code($strChemin);
            }
        } else {
            $this->strChemin = $strChemin;
        }
    }

    public function afficher(){
        $model = $this->model;
        global $authorized;
        if (http_response_code() == 200 && $authorized) {
            require_once "Views/header.php";
            require_once $this->strChemin;
            require_once "Views/footer.php";
        } else {
            echo "<h1>$model</h1>";
        }
    }

    /**
     * @param mixed $model
     */
    public function setModel($model) {
        $this->model = $model;
    }
    
    public function getModel() {
        return $this->model;
    }
}