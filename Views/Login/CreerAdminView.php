<link href="Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<div class="sCreerAdmin">
    <form id="frmCreerAdmin" method="post" action="index.php?controller=Login&action=CreerAdmin" class="sForm">
        <table class="sTableFormulaire">
            <tr>
                <td>
                    <h1>Premiere Execution</h1>
                </td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbNomUtilisateur" name="tbNomUtilisateurAdmin" type="text" placeholder="Nom D'Utilisateur"/></td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbNomComplet" name="tbNomCompletAdmin" type="text" placeholder="Nom Complet"/></td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbCourriel" name="tbCourrielAdmin" type="text" placeholder="Courriel"/></td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbMotDePasse" name="tbMotDePasseAdmin" type="password" placeholder="Mot de passe"/></td>
            </tr>
            <tr>
                <td><input class="sBtn" id="btnSoumettre" name="btnSoumettre" type="submit" value="Creer"/></td>
            </tr>
        </table>
    </form>
</div>