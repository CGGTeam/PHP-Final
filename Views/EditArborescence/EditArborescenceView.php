<link href="Views/EditArborescence/EditArborescenceStyle.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<form class="container" method="post" action="?controller=EditArborescence&action=Confirmer">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Session</th>
            <th scope="col">Sigle</th>
            <th scope="col">Professeur</th>
            <th scope="col">Date du cours</th>
            <th scope="col">Titre</th>
            <th scope="col">Supprimer?</th>
        </tr>
        <tr ag-for="doc in model">
            <td>{{doc.id}}</td>
            <td>{{doc.session}}</td>
            <td>{{doc.sigle}}</td>
            <td>{{doc.ajoutePar}}</td>
            <td>{{doc.dateCours}}</td>
            <td><a href="{{doc.hyperLien}}">{{doc.titre}}</a></td>
            <td>
                <div class="checkbox">
                    <input name="checkbox" type="checkbox" id="checkbox">
                    <em class="helper"></em>
                </div>
            </td>
        </tr>
        <tr>
    </table>
    <button type="submit" name="button" id="button">
        Supprimer
    </button>
    <button type="button" name="button" id="button"
            onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
        Retour
    </button>
</form>