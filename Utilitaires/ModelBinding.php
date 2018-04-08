<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 04/04/18
 * Time: 23:44
 */

class ModelBinding
{
    /** @var mysql $bd */
    private $bd;
    private $modelState;
    
    /**
     * ModelBinding constructor.
     * @param array $properties
     * @param bool $binAjout
     */
    public function __construct(Array $properties=array(), $binAjout=false)
    {
        global $bd;
        $this->bd = $bd;

        $this->modelState = $binAjout ? ModelState::Added : ModelState::Same;
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function saveChangesOnObj(){
        //TODO saveChanges pour chaque modelState
        if($this->modelState != ModelState::Same && $this->modelState != ModelState::Invalid) {
            switch ($this->modelState) {
                case ModelState::Added:
                    $this->modelState = $this->bd->insereEnregistrementTb(get_class($this), call_user_func('get_object_vars'), $this) ?
                        ModelState::Same : ModelState::Invalid;
                    break;
            }
        }
    }

    public static function bindToClass($result, $class){
        $objBound = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $objBound = new $class($row);
            }
        }
        return $objBound;
    }
    
    public function getModelState() {
        return $this->modelState;
    }
    
    public function setModelState($modelState) {
        $this->modelState = $modelState;
    }
}