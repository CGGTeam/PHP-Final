
<script>

    const ERREURS = ["absent", "collision dans la BD", "absent de la BD", "invalide", "en doublon", "valide"];

    $scope.tbErreurs = [[],[],[],[],[],[]];
    $scope.binErreur = false;
    $_anguleuxInterne.customEndingEvents.push(function (element) {
        if(element.tagName === "TR"){
            let tTr = Array.from(document.getElementById("tableParent").querySelectorAll("TR"));
            tTr.filter(x => !x.classList.contains("ag-disp-none")).forEach(tr => {
                    tTd = Array.from(tr.querySelectorAll("TD")).filter(y => !y.classList.contains("ag-disp-none"));
                    tTd.forEach((td, i) => {
                        if(!tr.$_objRef[tr.$_objIndex][i].valide){
                            td.style.backgroundColor = "red";
                            $scope.tbErreurs[tr.$_objRef[tr.$_objIndex][i].raison].pushIfNotExist(document.getElementById("tableParent").querySelectorAll("TH")[i].innerHTML, (x,y) => x === y);
                            $scope.binErreur = true;
                        }
                    });
            });
        }

        let strMessage = "";
        $scope.tbErreurs.forEach((e,i) => {
            if(e.length > 0){
                strMessage += "<i>";
                e.forEach(x => strMessage += x + ", ");
                strMessage += "</i> ";
                strMessage += "<b>" +  ERREURS[i] + "</b>";
                strMessage += "<br/>";
            }
        });
        document.getElementById("message").innerHTML = strMessage;

        if($scope.binErreur){
            document.getElementById("ddlSession").disabled = true;
        }
    });

    function onChangeSession(e) {
        let formData = new FormData();
        formData.append("ddlSession", e.target.value);
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "?controller=EditGroupes&action=ValiderSession");
        xhttp.onreadystatechange = function () {
            if(xhttp.readyState === XMLHttpRequest.DONE){
                console.log(JSON.parse(xhttp.responseText));
                let tReponse = JSON.parse(xhttp.responseText).tDonnees;
                let pret = true;
                let tTr = Array.from(document.getElementById("tableParent").querySelectorAll("TR"));
                tTr.filter(x => !x.classList.contains("ag-disp-none") && x.children[0].tagName !== "TH").forEach(tr => {
                    let tTd = Array.from(tr.querySelectorAll("TD")).filter(y => !y.classList.contains("ag-disp-none"));
                    if(tTd.length >= 8) {
                        for (let i = 4; i < 8; i++) {
                            if(tReponse[i - 3]) {
                                let element = tReponse[i - 3].find(x => x.valeur === tTd[i].children[0].innerHTML);
                                if (element && !element.valide) {
                                    tTd[i].style.backgroundColor = 'red';
                                    pret = false;
                                } else {
                                    tTd[i].style.backgroundColor = null;
                                }
                            }
                        }
                    }
                });

                document.getElementById("submit").disabled = !pret;

            }
        };
        xhttp.send(formData);
    }

</script>


<link href="Views/EditGroupes/groupesStyles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<div class="container">
    <form method="post" action="?controller=EditGroupes&action=Confirmer">
        <div class="table-container">
            <table border="1" cellspacing="5" cellpadding="5" id="tableParent">
                <tbody>
                <tr>
                    <th>NomUtilisateur</th>
                    <th>MotDePasse</th>
                    <th>NomComplet</th>
                    <th>Courriel</th>
                    <th>Sigle1</th>
                    <th>Sigle2</th>
                    <th>Sigle3</th>
                    <th>Sigle4</th>
                    <th>Sigle5</th>
                    <th>Verdict</th>
                </tr>
                <tr ag-for="x in model.tDonnees">
                    <td ag-for="y in x" attrib-bind-obj="tdAttrib">{{y.valeur}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <p id="message">
        </p>
        <select id="ddlSession" class="sessionSelect" onchange="onChangeSession(event)">
            <option value="" disabled selected>Choisir session</option>
            <option selected hidden disabled value="">Choisir une session</option>
            <option ag-for="session in model.tSessions">{{session.description}}</option>
        </select>
        <br/>
        <button type="submit" name="submit" id="submit" class="boutonsConfirm" disabled
                onclick="confirm('Êtes-vous certain de vouloir assigner ces informations?')">
            Confirmer
        </button>
        <button type="button" name="button" id="button" class="boutonsConfirm"
                onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
            Retour
        </button>
    </form>
</div>

