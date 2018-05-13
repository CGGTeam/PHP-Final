<link href="Views/EditReferences/EditReferencesStyle.css" rel="stylesheet" type="text/css"/>
<div class="divCentrage">
    <table class="tableauBoutons">
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeSessions">
                    <button name="btnType" value="Session" type="submit">
                        1. Sessions d'etude<br/>
                        <i style="font-size: small">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer un ou plusieurs documents</i>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCours">
                    <button name="btnType" value="Cours" type="submit">
                        2. Cours<br/>
                        <i style="font-size: small">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer une ou plusieurs sessions, cours, catégories de documents et/ou utilisateurs</i>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCoursSessions">
                    <button name="btnType" value="CoursSession" type="submit">
                        3. Cours-Session<br/>
                        <i style="font-size: small">Cliquez sur le lien ci-dessus pour assigner les privilèges d'accès aux documents pour un ou plusieurs utilisateurs</i>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeCategories">
                    <button name="btnType" value="Categorie" type="submit">
                        4. Catégories<br>
                        <i style="font-size: small">Cliquez sur le lien ci-dessus si vous désirez ajouter une série d'utilisateurs et les assigner à un cours-session existant</i>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=EditReferences&action=EditListeUtilisateurs">
                    <button name="btnType" value="Utilisateur" type="submit">
                        5. Utilisateurs<br>
                        <i style="font-size: small">Cliquez sur le lien ci-dessus si vous dériez effectuer du ménage dans la liste de docuements enregistrés</i>
                    </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="?controller=AdminMenu&action=AdminMenu">
                    <button type="submit">
                        6. Retourner au menu principal<br/>
                        <i style="font-size: small">Que dire de plus?</i>
                    </button>
                </form>
            </td>
        </tr>
    </table>
</div>