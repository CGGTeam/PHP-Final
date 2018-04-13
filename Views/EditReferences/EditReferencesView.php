<link href="Views/EditReferences/EditReferencesStyle.css" rel="stylesheet" type="text/css"/>
<div class="tableauBoutons">
    <table>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=Afficher">
                    <button name="btnType" value="Session" type="submit">
                        1. Sessions d'etude
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=Afficher">
                    <button name="btnType" value="Cours" type="submit">
                        2. Cours
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=Afficher">
                    <button name="btnType" value="CoursSession" type="submit">
                        3. Cours-Session
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=Afficher">
                    <button name="btnType" value="Categorie" type="submit">
                        4. Catégories
                    </button>
                </form>
                <a href="">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=Afficher">
                    <button name="btnType" value="Utilisateur" type="submit">
                        5. Utilisateurs
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=AdminMenu&action=AdminMenu">
                    <button type="submit">
                        6. Retourner au menu principal
                    </button>
                </form>
            </td>
        </tr>
    </table>
</div>