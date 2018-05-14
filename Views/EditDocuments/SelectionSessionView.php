<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>

<div>
    <h2 style="color: white">
        <span ag-template="true">Nombre de sessions: {{model.tCoursSessions.length}}</span><br/>
        <span ag-template="true">Nombre de documents: {{model.nbDocuments}}</span>
    </h2>
</div>
<form method="get">
<div style="padding-top: 2vh">
    <h3 style="color: white">Choisir un cours-session:</h3>
    <select name="session">
        <option ag-for="session in model.tSessions" selected>{{session.description}}</option>
    </select>
    <select name="cours">
        <option ag-for="cours in model.tCours" selected>{{cours.sigle}}</option>
    </select>
</div>
    <input type="hidden" name="controller" value="EditDocuments">
    <input type="hidden" name="action" value="EditDocuments">
<input type="submit" name="submit" id="submit" class="boutonsConfirm" value="Sélection">
</form>
<button type="button" name="button" id="button" class="boutonsConfirm"
        onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
    Retour
</button>