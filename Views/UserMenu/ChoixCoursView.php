<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Views/UserMenu/UserMenuStyle.css" rel="stylesheet" type="text/css"/>
<form method="post" action="?controller=UserMenu&action=AfficherCours" class="divChoix">
    <p>
        <label for="coursChoisi">
            Cours à visionner:
        </label>
        <select name="coursChoisi" id="coursChoisi">
            <option ag-for="x in model" selected>
                {{x.session}}_{{x.sigle}}
            </option>
        </select>
    </p>
    <p>
        <button type="submit" class="boutonSoumettre">
            Soumettre
        </button>
        <button type="button" name="button" id="button" class="boutonSoumettre"
                onclick="window.location='?controller=Login&action=Deconnexion';">
            Retour
        </button>
    </p>
</form>