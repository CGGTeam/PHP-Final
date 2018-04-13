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

<link href="Views/EditReferences/EditReferencesStyle.css" rel="stylesheet" type="text/css"/>

<div class="sContReferences container">
    <div id="contTable" class="sContTable">
        <table id="tableAffichage"></table>
    </div>
            <button class="btnRef"  onclick="btnAjouter();">Ajouter</button>
            <button class="btnRef" onclick="btnSauvgarder();">Sauvegarder</button>
            <button class="btnRef" onclick="btnSupprimer();">Supprimer</button>
    <script type="text/javascript" src="Views/EditReferences/js/main.js"></script>