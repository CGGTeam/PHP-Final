<?php
    /** @var array $model */
?>

<script>
    $scope.coursSession = [];
    $scope.utilisateurs = [];
    $scope.tbCours = [];
    $scope.model["CoursSession"].forEach(obj => {
        $scope.coursSession.push(new CoursSession(obj));
        $scope.coursSession[$scope.coursSession.length-1].modelState = 3;
        if($scope.tbCours.indexOf({session: obj.session, sigle: obj.sigle}) < 0){
            $scope.tbCours.push({session: obj.session, sigle: obj.sigle});
        }
    });


    $scope.model["Utilisateurs"].forEach(obj => {
        $scope.utilisateurs[obj.id] = new Utilisateur(obj);
        $scope.utilisateurs[obj.id].tbCours = new Array($scope.tbCours.length);
        $scope.utilisateurs[obj.id].tbCours.fill(false);
    });


    $scope.coursSession.forEach(obj => {
        let index = $scope.tbCours.map(function(e) { return e.session + "_" + e.sigle; }).indexOf(obj.session + '_' + obj.sigle);
        if(index > -1) {
            $scope.utilisateurs[obj.utilisateur].tbCours[index] = true;
        }
    });

    configPost(Utilisateur,["id","tbCours"],{tbCours: postTbCours});

    function postTbCours(objPost, objCourant) {
        objPost.tbCours = [];
        for(let i = 0; i < objCourant.tbCours.length; i++){
            if(objCourant.tbCours[i]){
                objPost.tbCours.push($scope.tbCours[i]);
            }
        }
    }


</script>

<link href="Style/privilegeStyles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>


<form class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <th>Utilisateurs</th>
                <th ag-for="cours in tbCours">
                    <div>{{cours.sigle}}</div>
                    <div class="sousTitre">{{cours.session}}</div>
                </th>
            </tr>
            <tr ag-for="util in utilisateurs">
                <td>{{util.nomComplet}}</td>
                <td ag-for="wack in util.tbCours">
                    <div class="checkbox">
                        <label>
                            <input name="checkbox" type="checkbox" for-bind="true" onclick="postEventList(event);postCouleursList(event);">
                            <em class="helper"></em>
                        </label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="button" name="submit" id="submit" onclick="postChanges('Utilisateur','?controller=EditPrivileges&action=Post')">
        Enregistrement
    </button>
    <button type="button" name="button" id="button"
            onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
        Retour
    </button>
</form>