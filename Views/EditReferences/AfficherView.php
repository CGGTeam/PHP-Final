<?php

    /**
     * @var ReferencesModel $model
     */

    echo "<script id='model' type='application/json'>";
    echo json_encode($model->donnees);
    echo "</script>";

    $initrep = scandir('Views/EditReferences/js/Models');
    $rep = array_splice($initrep,2, count($initrep));
    foreach($rep as $js) {
        echo "<script src=\"Views/EditReferences/js/Models/$js\"></script>";
    }

    echo "<script type='text/javascript'>/** @type {string} **/ var type = '$model->type';</script>";

?>
<script type="text/javascript" src="Views/EditReferences/js/main.js"></script>
<div class="sContReferences">
    <div class="sContActions">
        <table>
            <tr>
                <td>
                    <button>Ajouter</button>
                </td>
                <td>
                    <button>Sauvegarder</button>
                </td>
                <td>
                    <button>Supprimer</button>
                </td>
            </tr>
        </table>
    </div>
    <div id="contTable" class="sContTable">
        <table id="tableAffichage"></table>
    </div>
</div>