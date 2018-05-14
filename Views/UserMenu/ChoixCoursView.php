<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Views/UserMenu/UserMenuStyle.css" rel="stylesheet" type="text/css"/>
<form method="get" class="divChoix">
    <p>
        <label id="lblCours" for="coursChoisi" class="ddlCours">
            Cours à visionner:
        </label>
        <select name="coursChoisi" id="coursChoisi" class="ddlCours" required>
            <option value="" disabled selected>
                Sélectionner une session
            </option>
            <option ag-for="x in model">
                {{x.session}}_{{x.sigle}}
            </option>
        </select>
    </p>
    <p>
        <button type="submit" class="boutonsConfirm boutons-User">
            Soumettre
        </button>
        <button type="button" name="button" id="button" class="boutonsConfirm boutons-User"
                onclick="window.location='?controller=Login&action=Deconnexion';">
            Retour
        </button>
    </p>
    <input type="hidden" name="controller" value="UserMenu">
    <input type="hidden" name="action" value="AfficherCours">
</form>