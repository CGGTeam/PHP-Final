<link href="Views/UserMenu/UserMenuStyle.css" rel="stylesheet" type="text/css"/>
<form method="post" action="?controller=UserMenu&action=AfficherCours" class="divChoix">
    <h3>Visionner les documents d'un cours</h3>
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
    </p>
</form>