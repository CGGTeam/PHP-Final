<script>
    $scope.croissant = true;
</script>

<link href="Views/EditArborescence/EditArborescenceStyle.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<script type="text/javascript" src="Views/EditArborescence/EditArborescence.js"></script>
<!--<form class="container" method="post" action="?controller=EditArborescence&action=ConfirmerSuppressionBD">-->
<div class="container">
<table border="1" cellspacing="5" cellpadding="5">
    <tbody>
    <tr id="trTH">
        <th scope="col">#</th>
        <th scope="col">Session
            <a onclick="trier($scope.model,(a,b) => {
                if($scope.croissant)
                    return a.session.localeCompare(b.session);
                else
                    return b.session.localeCompare(a.session);
            });$scope.croissant = !$scope.croissant;">↑↓</a>
        </th>
        <th scope="col">Sigle</th>
        <th scope="col">Professeur
            <a onclick="trier($scope.model,(a,b) => {
                if($scope.croissant)
                    return a.ajoutePar - b.ajoutePar ;
                else
                    return b.ajoutePar - a.ajoutePar;
            });$scope.croissant = !$scope.croissant;">↑↓</a>
        </th>
        <th scope="col">Date du cours</th>
        <th scope="col">Titre
            <a onclick="trier($scope.model,(a,b) => {
                if($scope.croissant)
                    return a.titre.localeCompare(b.titre);
                else
                    return b.titre.localeCompare(a.titre);
            });$scope.croissant = !$scope.croissant;">↑↓</a>
        </th>
        <th scope="col" id="thEtat">Supprimer?</th>
    </tr>
    <tr id="tr_parent" ag-for="doc in model">
        <td>{{doc.id}}</td>
        <td>{{doc.session}}</td>
        <td>{{doc.sigle}}</td>
        <td>{{doc.ajoutePar}}</td>
        <td>{{doc.dateCours}}</td>
        <td><a attrib-bind-obj="docTitreLien">{{doc.titre}}</a></td>
        <td class="colSupprCB">
            <div class="checkbox">
                <label>
                    <input name="checkbox" type="checkbox" col1 for-bind="true" for-bind-path="toDelete">
                    <em class="helper"></em>
                </label>
            </div>
        </td>
    </tr>
    <tr>
</table>
<button type="submit" name="button" id="btnEnregistrer" class="boutonsConfirm" onclick="ConfirmerSuppressionBD();">
    Enregistrer
</button>
<button type="button" name="submit" id="btnSupprimer" class="boutonsConfirm" onclick="deleteSelected($scope.model)">
    Supprimer
</button>
<button type="button" name="button" id="btnRetour" class="boutonsConfirm"
        onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
    Retour
</button>
    <button id="btnNettoyage"
            class="boutonsConfirm"
            style="display: none;"
            type="button" name="btnNettoyage"
            onclick="ConfirmerSuppressionFichiers();">
        Nettoyage
    </button>
</div>
<!--</form>-->