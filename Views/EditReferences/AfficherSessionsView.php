<?php
    /**
     * @var ReferencesModel $model
     */
    $initrep = scandir('Views/EditReferences/js/Models');
    $rep = array_splice($initrep,2, count($initrep));
    foreach($rep as $js) {
        echo "<script src=\"Views/EditReferences/js/Models/$js\"></script>";
    }
?>
<script src="/Views/EditReferences/js/main.js"></script>
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
</div>
