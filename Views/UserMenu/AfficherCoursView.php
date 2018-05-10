<script>
    $scope.model.forEach(doc => {
        doc.joursRestants = Math.ceil((new Date(doc.dateAccesFin) - (new Date())) / (1000*60*60*24));
    });
    $scope.titreAttrib = {
        href: "{{doc.hyperLien}}",
    };
    $scope.descriptionAttrib = {
        onclick: "afficherDescription('{{doc.id}}')"
    };
    $scope.titreDescriptionAttrib = {
        id: "titre_{{doc.id}}"
    };
    function afficherDescription(id){
        id = "titre_" + id;
        document.getElementById(id).hidden = !document.getElementById(id).hidden;
    }


</script>

<link href="Views/UserMenu/AfficherCoursStyle.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<form class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
        <tr>
            <th scope="col">Numéro du<br/>document</th>
            <th scope="col">Date du cours</th>
            <th scope="col">Numéro de<br/>séquence</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Nombre de pages</th>
            <th scope="col">Dernière mise à jour</th>
            <th scope="col">Nombre de jours restants</th>
        </tr>
        <tr ag-for="doc in model">
            <td>{{doc.id}}</td>
            <td>{{doc.dateCours}}</td>
            <td>{{doc.noSequence}}</td>
            <td>{{doc.categorie}}</td>
            <td>
                <a attrib-bind-obj="titreAttrib">{{doc.titre}}</a>
                <div attrib-bind-obj="titreDescriptionAttrib" hidden>
                    {{doc.description}}
                </div>
            </td>
            <td>
                <button type="button" attrib-bind-obj="descriptionAttrib">DESCRIPTION</button>
            </td>
            <td>{{doc.nbPages}} p.</td>
            <td>{{doc.dateVersion}}</td>
            <td>{{doc.joursRestants}} jours</td>
        </tr>
        </tbody>
    </table>
    <button type="button" name="button" id="button"
            onclick="window.location='?controller=UserMenu&action=ChoixCours';">
        Retour
    </button>
</form>