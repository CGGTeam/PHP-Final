<body>
<link href="/michael/michael/Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<div class="sHeaderLogin">
    <table class="headerTable">
        <tr>
            <td class="d1">
                <span class="hCieName">PaperSensation</span>
            </td>
            <td class="d2">
                <span class="hCentre"></span>
            </td>
            <td class="d3">
                <span class="hDroite">Annuler</span>
            </td>
        </tr>
    </table>
</div>
<div id="sCreerAdmin">
    <form id="frmCreerAdmin" method="post" action="index.php?controller=Login&action=CreerAdmin" class="sForm">
        <table class="sTableFormulaire" style="width: 45%">
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
<div class="sFooterBas">
    <p class="sTexteFooter">&copy; PaperSensation 2018, tous les droits reserves.</p>
</div>
</body>