<link href="Views/EditReferences/EditReferencesStyle.css" rel="stylesheet" type="text/css"/>
<div class="divCentrage">
    <table class="tableauBoutons">
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeSessions">
                    <button name="btnType" value="Session" type="submit">
                        <p>1. Sessions d'etude
                        <p>
                        <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer un ou
                            plusieurs documents</p>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCours">
                    <button name="btnType" value="Cours" type="submit">
                        <p>2. Cours</p>
                        <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer une ou
                            plusieurs sessions, cours, catégories de documents et/ou utilisateurs</p>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCoursSessions">
                    <button name="btnType" value="CoursSession" type="submit">
                        <p>3. Cours-Session</p>
                        <p class="desc">Cliquez sur le lien ci-dessus pour assigner les privilèges d'accès aux documents
                            pour un ou plusieurs utilisateurs</p>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCategories">
                    <button name="btnType" value="Categorie" type="submit">
                        <p>4. Catégories</p>
                        <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter une série d'utilisateurs
                            et les assigner à un cours-session existant</p>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeUtilisateurs">
                    <button name="btnType" value="Utilisateur" type="submit">
                        <p>5. Utilisateurs</p>
                        <p class="desc">Cliquez sur le lien ci-dessus si vous désirez effectuer du ménage dans la liste
                            de docuements enregistrés</p>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=AdminMenu&action=AdminMenu">
                    <button type="submit">
                        <p>6. Retourner au menu principal</p>
                        <p class="desc">Que dire de plus?</p>
                    </button>
                </form>
            </td>
        </tr>
    </table>
</div>