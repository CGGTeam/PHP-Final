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
                <span class="hDroite">Connexion</span>
            </td>
        </tr>
    </table>
</div>
<div>
<form method="post" action="" class="sForm">
    <table class="sTableFormulaire">
        <tr>
            <td colspan="2">
                <h1 class="sTitreFormulaire">
                    Connexion
                </h1>
            </td>
        </tr>
        <tr>
            <td><input class="sTb" name="tbNomUtilisateur" type="text" placeholder="Utilisateur"></td>
        </tr>
        <tr>
            <td><input class="sTb" name="tbMotDePasse" type="password" placeholder="Mot de passe"></td>
        </tr>
        <tr>
            <td class="sContSingleButton" colspan="2">
                <input class="sBtn" type="submit" value="Connexion">
            </td>
        </tr>
    </table>
</form>
</div>
<div class="sFooterBas">
    <p class="sTexteFooter">&copy; PaperSensation 2018, tous les droits reserves.</p>
</div>
<h2><?= $model->etat ?></h2>
<?php
    /** @var LoginModel $model */
?>