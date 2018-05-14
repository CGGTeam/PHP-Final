<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Views/UserMenu/UserMenuStyle.css" rel="stylesheet" type="text/css"/>
<form method="post" action="?controller=UserMenu&action=AfficherCours" class="divChoix">
    <p>
        <label for="coursChoisi" class="ddlCours">
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
        <button type="submit" class="boutonsConfirm">
            Soumettre
        </button>
        <button type="button" name="button" id="button" class="boutonsConfirm"
                onclick="window.location='?controller=Login&action=Deconnexion';">
            Retour
        </button>
    </p>
</form>