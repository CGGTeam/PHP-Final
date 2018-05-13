<script>

    $scope.model.forEach((x,i) => $scope.model[i] = new Session(x));
    $scope.backup = JSON.parse(JSON.stringify($scope.model));
    $scope.model.unshift(new Session());
    $scope.model.modelState = 0;
    $scope.trAttrib = {
        id: "tr_{{session.description}}"
    };
    $scope.annuleAttrib = {
        onclick: "annuler('{{session.description}}')"
    };
    configPost(Session);
    configCouleurs();

    function annuler(id) {
        let aAnnuler = $scope.model.find(obj => obj.description === id);
        let aRetrouver = $scope.backup.find(obj => obj.description === id);
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
                $scope.model[0] = new Session();
                $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
                reconstruirePost($scope.model);
            }else{
                 Object.assign($scope.model[0], new Session());
            }
        }
    }

    function removeFirst(){
        delete $_postObj.tabObjToPost[0];
    }

    function nouvObj() {
        $scope.model.unshift(new Session());
        //TODO reconstruire tableau + configPost
        $scope.model[1].modelState = 0;
        $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
        configPost(Session);
        document.getElementById("tr_" + $scope.model[1].description).style.backgroundColor = 'green';
        reconstruirePost($scope.model);
        reconstruireStyle($scope.model);
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
            <th scope="col">Description</th>
            <th scope="col">dateDebut</th>
            <th scope="col">debutFin</th>
            <th scope="col">Annuler</th>
        </tr>
        <tr ag-for="session in model" attrib-bind-obj="trAttrib" id="tr_parent">
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox">
                        <em class="helper"></em>
                    </label>
                </div>
            </td>
            <td><input type="text" for-bind="true" for-bind-path="description" name="main_id"></td>
            <td><input type="date" for-bind="true" for-bind-path="dateDebut"></td>
            <td><input type="date" for-bind="true" for-bind-path="dateFin"></td>
            <td>
                <button type="button" attrib-bind-obj="annuleAttrib">&nbsp;X&nbsp</button>
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