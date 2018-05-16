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
            $this->valider();
    }

    public function saveChangesOnObj(){
    
        if ($this->modelState != ModelState::Same && $this->modelState != ModelState::Invalid) {
            switch ($this->modelState) {
                case ModelState::Added :
                    $this->modelState = mysql::getBD()->insereEnregistrementTb(get_class($this), $this->tbValeurs) ?
                        ModelState::Same : ModelState::Invalid;
                    log_fichier(mysql::getBD()->requete);
                    break;
                case ModelState::Same :
                    break;
                case ModelState::Deleted :
                    $tCles = mysql::getBD()->retourneClesPrimaires(get_class($this))->fetch_all();
                    $strConditions = "";
    
                    foreach ($this->tbValeurs as $strNomChamp => $valeur) {
                        foreach ($tCles as $cle){
                            if ($strNomChamp == $cle[4]) {
                                $strConditions .= "$strNomChamp = '$valeur' AND ";
                            }
                        }
                    }

                    $strConditions = substr($strConditions, 0, strlen($strConditions) - 5);
                    mysql::getBD()->supprimeEnregistrements(get_class($this), $strConditions);
                    log_fichier(mysql::getBD()->requete);
                    break;
                case ModelState::Modified :

                    $tCles = mysql::getBD()->retourneClesPrimaires(get_class($this))->fetch_row();
                    $strConditions = "";
    
                    foreach ($this->tbValeurs as $strNomChamp => $valeur) {
                        foreach ($tCles as $cle){
                            if ($strNomChamp == $cle[4]) {
                                $strConditions .= "$strNomChamp = '$valeur' AND ";
                            }
                        }
                    }
                    $strConditions = substr($strConditions, 0, strlen($strConditions) - 5);
        
                    $strSets = "";
                    foreach ($this->tbValeurs as $strNomChamp => $valeur) {
                        $strSets .= "$strNomChamp='$valeur', ";
                    }
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
    
        /**
         * Vérifie si les propriétés de l'objet sont valides. Mets le model state à ModelState::INVALID si elles ne le sont pas.
         * @return bool si l'objet contient des données valides.
         */
        abstract function valider();
}