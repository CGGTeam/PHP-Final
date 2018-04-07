<form id="frmSaisieLogin" action="index.php?controller=Login&action=Login" method="post">
    <input id="tbNomUtilisateur" name="tbNomUtilisateur" type="text"/>
    <input id="tbMotDePasse" name="tbMotDePasse" type="text"/>
    <input id="btnSubmit" type="submit"/>
</form>


<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-03
     * Time: 4:43 PM
     */
    
    echo $model->etat;