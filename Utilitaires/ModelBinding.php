<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 04/04/18
 * Time: 23:44
 */
    
    abstract class ModelBinding
{
    /** @var mysql $bd */
    private $modelState;
    private $tbValeurs;
    
    /**
     * ModelBinding constructor.
     * @param array $properties
     * @param bool $binAjout
     */
        public function __construct(Array $properties = array(), $binAjout = false) {
        $this->modelState = $binAjout ? ModelState::Added : ModelState::Same;
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
            $this->tbValeurs[$key] = $value;
        }
    }

    public function saveChangesOnObj(){

        //TODO saveChanges pour chaque modelState
        if($this->modelState != ModelState::Same && $this->modelState != ModelState::Invalid) {
            switch ($this->modelState) {
                case ModelState::Added :
                    $this->modelState = mysql::getBD()->insereEnregistrementTb(get_class($this), $this->tbValeurs) ?
                        ModelState::Same : ModelState::Invalid;
                    log_fichier( var_export(mysql::getBD()->OK) . '     ' . mysql::getBD()->requete);
                    break;
                case ModelState::Same :
                    break;
                case ModelState::Deleted :
                    $tCles = mysql::getBD()->retourneClesPrimaires(get_class($this))->fetch_row();
                    $strConditions = "";
    
                    foreach ($this->tbValeurs as $nomChamp => $valeur) {
                        for ($i = 0; $i < sizeof($tCles); $i += 13) {
                            if ($nomChamp == $tCles[$i + 4]) {
                                $strConditions .= "$nomChamp = '$valeur' AND ";
                            }
                        }
                    }
                    $strConditions = substr($strConditions, 0, strlen($strConditions) - 5);
                    mysql::getBD()->supprimeEnregistrements(get_class($this), $strConditions);
                    break;
                case ModelState::Modified :

                    $tCles = mysql::getBD()->retourneClesPrimaires(get_class($this))->fetch_row();
                    $strConditions = "";
        
                    foreach ($this->tbValeurs as $nomChamp => $valeur) {
                        for ($i = 0; $i < sizeof($tCles); $i += 13) {
                            if ($nomChamp == $tCles[$i + 4]) {
                                $strConditions .= "$nomChamp = '$valeur' AND ";
                            }
                        }
                    }
                    $strConditions = substr($strConditions, 0, strlen($strConditions) - 5);
        
                    $strSets = "";
                    foreach ($this->tbValeurs as $nomChamp => $valeur) {
                        $strSets .= "$nomChamp='$valeur', ";
                    }
                    log_fichier($strSets);
                    $strSets = substr($strSets, 0, strlen($strSets) - 2);
                    mysql::getBD()->modifieEnregistrements(get_class($this), $strSets, $strConditions);
                    break;
                default:
                    echo "NOT IMPLEMENTED";
                    break;
            }
        }
    }

    public static function bindToClass($result, $class){
        $objBound = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $objBound[] = new $class($row);
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