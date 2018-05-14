<script>

    $scope.model.forEach((x,i) => $scope.model[i] = new Cours(x));
    $scope.model.forEach(x => x.toDelete = false);
    $scope.backup = JSON.parse(JSON.stringify($scope.model));
    $scope.model.unshift(new Cours());
    $scope.model.modelState = 0;
    $scope.trAttrib = {
        id: "tr_{{cours.sigle}}"
    };
    $scope.annuleAttrib = {
        onclick: "annuler('{{cours.sigle}}')"
    };
    configPost(Cours);
    configCouleurs();

    function annuler(id) {
        let aAnnuler = $scope.model.find(obj => obj.sigle === id);
        let aRetrouver = $scope.backup.find(obj => obj.sigle === id);
        if(aAnnuler){
            if(aRetrouver) {
                Object.assign(aAnnuler, aRetrouver);
                let trObj = document.getElementById("tr_" + id);
                let event = new Event("change");
                event.$_init = true;
                Array.from(trObj.getElementsByTagName("input")).forEach(x => x.dispatchEvent(event));
                trObj.style.backgroundColor = null;
            }else if($scope.model.indexOf(aAnnuler) > 0){
                $scope.model = $scope.model.splice($scope.model.indexOf(aAnnuler),1);
                $scope.model[0] = new Cours();
                $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
                reconstruirePost($scope.model);
            }else{
                Object.assign($scope.model[0], new Cours());
            }
        }
    }

    function removeFirst(){
        delete $_postObj.tabObjToPost[0];
    }

    function nouvObj() {
        $scope.model.unshift(new Cours());
        //TODO reconstruire tableau + configPost
        $scope.model[1].modelState = 0;
        $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
        configPost(Cours);
        document.getElementById("tr_" + $scope.model[1].sigle).style.backgroundColor = 'green';
        reconstruirePost($scope.model);
        reconstruireStyle($scope.model);
    }

</script>

<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Style/editDocumentsStyle.css" rel="stylesheet" type="text/css">
<div class="container">
    <div class="table-container">
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
                <th scope="col">Sigle</th>
                <th scope="col">Titre</th>
                <th scope="col">Annuler</th>
            </tr>
            <tr ag-for="cours in model" attrib-bind-obj="trAttrib" id="tr_parent">
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="checkbox" type="checkbox" for-bind="true" for-bind-path="toDelete">
                            <em class="helper"></em>
                        </label>
                    </div>
                </td>
                <td><input type="text" for-bind="true" for-bind-path="sigle"
                           pattern="(\d{3}-[A-Z0-9]{3})|(ADM-[AHE]\d{2})"
                           name="main_id"></td>
                <td><input type="text" for-bind="true" for-bind-path="titre" minlength="5" maxlength="50"></td>
                <td>
                    <button type="button" attrib-bind-obj="annuleAttrib">&nbsp;X&nbsp</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="postChanges('Cours')">
        Enregistrement
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="nouvObj()">
        Ajouter
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="deleteSelected($scope.model, 'sigle')">
        Supprimer
    </button>
    <button type="button" name="button" id="button" class="boutonsConfirm"
            onclick="window.location='?controller=EditReferences&action=EditReferences';">
        Retour
    </button>
</div>