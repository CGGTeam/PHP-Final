<link href="Views/AdminMenu/AdminMenuStyle.css" rel="stylesheet" type="text/css"/>
<table class="tableauBoutons">
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditDocuments">
                <button type="submit">
                    1. Mettre à jour la liste des documents
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditReferences">
                <button type="submit">
                    2. Mettre à jour les tables de référence
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditPrivileges">
                <button type="submit">
                    3. Assigner les privilèges d'accès aux documents
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditGroupes">
                <button type="submit">
                    4. Assigner un groupe d'utilisateurs à un cours-session
                </button>
            </form>
            <a href="">
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="?controller=AdminMenu&action=EditArborescence">
                <button type="submit">
                    5. Reconstruire l'arborescence des documents
                </button>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="index.php?controller=Login&action=Deconnexion">
                <button type="submit">
                    6. Terminer l'application
                </button>
            </form>
        </td>
    </tr>
</table>

