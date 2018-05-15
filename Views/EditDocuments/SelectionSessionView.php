<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Views/EditDocuments/editDocumentsStyle.css" rel="stylesheet" type="text/css">
<div class="container-selection">
    <h2 ag-template="true">Nombre de cours-sessions: {{model.intNbCoursSessions}}</h2><br/>
    <h2 ag-template="true"> Nombre de documents: {{model.intNbDocuments}}</h2>
    <form method="get">
        <div>
            <h3>Choisir un cours-session:</h3>
            <select name="session" required class="ddlCours">
                <option selected hidden disabled value="">Choisir une session</option>
                <option ag-for="session in model.tSessions">{{session.description}}</option>
            </select>
            <select name="cours" required class="ddlCours">
                <option selected hidden disabled value="">Choisir un cours</option>
                <option ag-for="cours in model.tCours">{{cours.sigle}}</option>
            </select>
        </div>
        <input type="hidden" name="controller" value="EditDocuments">
        <input type="hidden" name="action" value="EditDocuments">
        <button type="submit" name="submit" id="submit" class="boutonsConfirm" value="Sélection">Soumettre</button>
        <button type="button" name="button" id="button" class="boutonsConfirm"
                onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
            Retour
        </button>
    </form>
</div>
