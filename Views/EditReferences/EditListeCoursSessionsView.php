<script>

    $scope.model.tDonnees.forEach((x,i) => $scope.model[i] = new CoursSession(x));
    $scope.model.tDonnees.forEach(x => x.cleUnique = x.session + "_" + x.sigle + "_" + x.id);
    $scope.backup = JSON.parse(JSON.stringify($scope.model));
    $scope.model.tDonnees.unshift(new CoursSession());
    $scope.trAttrib = {
        id: "tr_{{cs.cleUnique}}"
    };
    $scope.annuleAttrib = {
        onclick: "annuler('{{cs.cleUnique}}')"
    };
    $scope.utilAttrib = {
        value: "{{cs.id}}"
    };
    configPost(CoursSession);
    configCouleurs();

    function annuler(id) {
        let aAnnuler = $scope.model.tDonnees.find(obj => obj.cleUnique=== id);
        let aRetrouver = $scope.backup.find(obj => obj.cleUnique === id);
        if(aAnnuler){
            if(aRetrouver) {
                Object.assign(aAnnuler, aRetrouver);
                let trObj = document.getElementById("tr_" + id);
                let event = new Event("change");
                event.$_init = true;
                Array.from(trObj.getElementsByTagName("input")).forEach(x => x.dispatchEvent(event));
                trObj.style.backgroundColor = null;
            }else if($scope.model.tDonnees.indexOf(aAnnuler) > 0){
                $scope.model.tDonnees = $scope.model.tDonnees.splice($scope.model.tDonnees.indexOf(aAnnuler),1);
                $scope.model[0] = new CoursSession();
                $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
                reconstruirePost($scope.model.tDonnees);
            }else{
                Object.assign($scope.model.tDonnees[0], new CoursSession());
            }
        }
    }

    function removeFirst(){
        delete $_postObj.tabObjToPost[0];
    }

    function nouvObj() {
        $scope.model.tDonnees.unshift(new CoursSession());
        //TODO reconstruire tableau + configPost
        $scope.model.tDonnees[1].modelState = 0;
        $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
        configPost(CoursSession);
        document.getElementById("tr_" + $scope.model.tDonnees[1].cleUnique).style.backgroundColor = 'green';
        reconstruirePost($scope.model.tDonnees);
    }

</script>

<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Style/editDocumentsStyle.css" rel="stylesheet" type="text/css">
<div class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
        <tr>
            <th>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox">
                        <em class="helper"></em>
                    </label>
                </div>
            </th>
            <th scope="col">Session</th>
            <th scope="col">Sigle</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Annuler</th>
        </tr>
        <tr ag-for="cs in model.tDonnees" attrib-bind-obj="trAttrib" id="tr_parent">
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox">
                        <em class="helper"></em>
                    </label>
                </div>
            </td>
            <td><input type="text" for-bind="true" for-bind-path="session"></td>
            <td><input type="text" for-bind="true" for-bind-path="sigle"></td>
            <td>
                <select attrib-bind-obj="utilAttrib" for-bind="true" for-bind-path="id">
                    <?php
                    foreach ($model->tAdmin as $util){
                        ?>
                        <option value="<?=$util->id?>"><?=$util->nomComplet?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <button type="button" attrib-bind-obj="annuleAttrib">&nbspX&nbsp</button>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="postDocuments()">
        Enregistrement
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="nouvObj()">
        Ajouter
    </button>
    <button type="button" name="button" id="button" class="boutonsConfirm"
            onclick="window.location='?controller=EditReferences&action=EditReferences';">
        Retour
    </button>
</div>