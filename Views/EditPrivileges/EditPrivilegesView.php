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

    console.log($scope);
    
    function enregistrer() {

    }

    function modifier(id) {
        for(session in $scope.tbCours) {
            $scope.tbCours[session].forEach(sigle => {
                let coursSessionEtat = document.getElementById(session + '_' + sigle + '_' + id).checked;
                let objCoursSession = new CoursSession({
                    session: session,
                    utilisateur: id,
                    sigle: sigle
                });
                objCoursSession.modelState = 3;
                if(coursSessionEtat && $scope.coursSession.indexOf(objCoursSession) < 0){
                    objCoursSession.modelState = 0;
                    $scope.coursSession.push(objCoursSession);
                }else if($scope.coursSession.indexOf(objCoursSession) > -1){
                    $scope.coursSession[$scope.coursSession.indexOf(objCoursSession)].modelState = 1;
                }
            });
        }
    }

</script>

<link href="Style/privilegeStyles.css" rel="stylesheet" type="text/css">


<form class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <th>Utilisateurs</th>
                <th ag-for="cours in tbCours">
                    {{cours.sigle}}
                    <div class="sousTitre">{{cours.session}}</div>
                </th>
            </tr>
        <!--
        <tr ag-for="util in utilisateurs" id="tr_{{util.id}}">
            <td>{{util.nomComplet}}</td>
            <td ag-for="cours in util.tbCours">
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" data-bind="{{cours}}">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        -->
        </tbody>
    </table>
</form>



<form class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
        <tr>
            <th scope="col">Nom d'utilisateur / Cours-Session</th>
            <th scope="col">ZZZ-ZZZ
                <div class="sousTitre">A-2099</div>
            </th>
            <th scope="col">ZZZ-ZZZ
                <div class="sousTitre">A-2099</div>
            </th>
            <th scope="col">...</th>
            <th scope="col">ZZZ-ZZZ
                <div class="sousTitre">A-2099</div>
            </th>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td> Nom, Prenom</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
            <td>&nbsp;</td>
            <td>
                <div class="checkbox">
                    <label>
                        <input name="checkbox" type="checkbox" id="checkbox">
                        <em class="helper"></em> </label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="submit" name="submit" id="submit">
        Enregistrement
    </button>
    <button type="button" name="button" id="button"
            onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
        Retour
    </button>
</form>