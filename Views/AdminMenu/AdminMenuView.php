<link href="Views/AdminMenu/AdminMenuStyle.css" rel="stylesheet" type="text/css"/>
<table class="tableauBoutons">
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditDocuments">
                <button type="submit">
                    <p>1. Mettre à jour la liste des documents</p>
                    <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer un ou
                        plusieurs documents.</p>
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditReferences">
                <button type="submit">
                    <p>2. Mettre à jour les tables de référence</p>
                    <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer une ou
                        plusieurs sessions, cours, catégories de document et/ou utilisateurs.</p>
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditPrivileges">
                <button type="submit">
                    <p>3. Assigner les privilèges d'accès aux documents</p>
                    <p class="desc">Cliquez sur le lien ci-dessus pour assigner les privilèges d'accès aux documents
                        pour un ou plusieurs utilisateurs.</p>
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditGroupes">
                <button type="submit">
                    <p>4. Assigner un groupe d'utilisateurs à un cours-session</p>
                    <p class="desc">Cliquez sur le lien ci-dessus si vous désirez ajouter une série d'utilisateurs et
                        les assigner à un cours-session existant.</p>
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditArborescence">
                <button type="submit">
                    <p>5. Reconstruire l'arborescence des documents</p>
                    <p class="desc">Cliquez sur le lien ci-dessus si vous désirez effectuer du ménage dans les listes de
                        documents enregistrés.</p>
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="module-admin.php?controller=Login&action=Deconnexion">
                <button type="submit">
                    <p>6. Terminer l'application</p>
                    <p class="desc">Que dire de plus ?</p>
                </button>
            </form>
        </td>
    </tr>
</table>

