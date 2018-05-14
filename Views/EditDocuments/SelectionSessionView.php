<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>

<div>
    <h2 style="color: white">
        <span ag-template="true">Nombre de cours-sessions: {{model.intNbCoursSessions}}</span><br/>
        <span ag-template="true">Nombre de documents: {{model.intNbDocuments}}</span>
    </h2>
</div>
<form method="get">
<div style="padding-top: 2vh">
    <h3 style="color: white">Choisir un cours-session:</h3>
    <select name="session" required>
        <option selected hidden disabled value="">Choisir une session</option>
        <option ag-for="session in model.tSessions">{{session.description}}</option>
    </select>
    <select name="cours" required>
        <option selected hidden disabled value="">Choisir un cours</option>
        <option ag-for="cours in model.tCours">{{cours.sigle}}</option>
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