<?php

    /**
     * @var ReferencesModel $model
     */

    echo "<script id='model' type='application/json'>";
    echo json_encode($model->donnees);
    echo "</script>";

    echo "<script type='text/javascript'>/** @type {string} **/ var type = '$model->type';</script>";

?>
<link href="Views/EditReferences/EditReferencesStyle.css" rel="stylesheet" type="text/css"/>
<div class="container sContReferences">
        <table id="tableAffichage"></table>
    <div>
        <table class="tableauBoutons">
            <tr>
                <td>
                    <button class="btnRef" onclick="btnAjouter();">Ajouter</button>
                </td>
                <td>
                    <button class="btnRef" onclick="btnSauvgarder();">Sauvegarder</button>
                </td>
                <td>
                    <button class="btnRef" onclick="btnSupprimer();">Supprimer</button>
                </td>
                <td>
                    <button class="btnRef" type="button" name="button" id="button"
                            onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
                        Retour
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <script type="text/javascript" src="Views/EditReferences/js/main.js"></script>
</div>

<form method="post" action="?controller=EditReferences&action=Afficher" id="frmSecret">
    <input id="hdType" name="btnType" type="hidden" value="<?=$model->type?>"/>
</form>

