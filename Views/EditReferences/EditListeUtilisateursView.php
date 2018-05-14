<script>

    $scope.model.forEach((x,i) => $scope.model[i] = new Utilisateur(x));
    $scope.backup = JSON.parse(JSON.stringify($scope.model));
    $scope.model.unshift(new Utilisateur());
    $scope.model.modelState = 0;
    $scope.trAttrib = {
        id: "tr_{{util.description}}"
    };
    $scope.annuleAttrib = {
        onclick: "annuler('{{util.description}}')"
    };
    configPost(Utilisateur);
    configCouleurs();

    function annuler(id) {
        let aAnnuler = $scope.model.find(obj => obj.id === id);
        let aRetrouver = $scope.backup.find(obj => obj.id === id);
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
                $scope.model[0] = new Utilisateur();
                $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
                reconstruirePost($scope.model);
            }else{
                Object.assign($scope.model[0], new Utilisateur());
            }
        }
    }

    function removeFirst(){
        delete $_postObj.tabObjToPost[0];
    }

    function nouvObj() {
        $scope.model.unshift(new Utilisateur());
        $scope.model[1].modelState = 0;
        $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
        configPost(Utilisateur);
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
                        <input name="checkbox" type="checkbox" onchange="document.querySelectorAll('[col1]').forEach(x => x.checked = event.target.checked)">
                        <em class="helper"></em>
                    </label>
                </div>
            </th>
            <th scope="col">ID</th>
            <th scope="col">nom d'utilisateur</th>
            <th scope="col">Mot de passe</th>
            <th scope="col">Admin?</th>
            <th scope="col">Nom complet</th>
            <th scope="col">Courriel</th>
            <th scope="col">Annuler</th>
        </tr>
        <tr ag-for="util in model" attrib-bind-obj="trAttrib" id="tr_parent">
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" for-bind="true" for-bind-path="toDelete" col1>
                        <em class="helper"></em>
                    </label>
                </div>
            </td>
            <td><input type="text" for-bind="true" for-bind-path="id" name="main_id" disabled></td>
            <td><input type="text" for-bind="true" for-bind-path="nomUtilisateur"></td>
            <td><input type="password" for-bind="true" for-bind-path="motDePasse"></td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" for-bind="true" for-bind-path="statutAdmin">
                        <em class="helper"></em>
                    </label>
                </div>
            </td>
            <td><input type="text" for-bind="true" for-bind-path="nomComplet"></td>
            <td><input type="email" for-bind="true" for-bind-path="courriel"></td>
            <td>
                <button type="button" attrib-bind-obj="annuleAttrib">&nbsp;X&nbsp</button>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="postChanges('Utilisateur')">
        Enregistrement
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="nouvObj()">
        Ajouter
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="deleteSelected($scope.model)">
        Supprimer
    </button>
    <button type="button" name="button" id="button" class="boutonsConfirm"
            onclick="window.location='?controller=EditReferences&action=EditReferences';">
        Retour
    </button>
</div>