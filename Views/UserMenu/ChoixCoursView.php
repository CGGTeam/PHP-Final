<link href="Views/UserMenu/UserMenuStyle.css" rel="stylesheet" type="text/css"/>
<form method="post" action="?controller=UserMenu&action=AfficherCours" class="divChoix">
    <p>
        <label for="ddlCoursChoisi">
            Cours à visionner:
        </label>
        <select id="ddlCoursChoisi">
            <option>
                Cours 1
            </option>
            <option>
                Cours 2
            </option>
            <option>
                Cours 3
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