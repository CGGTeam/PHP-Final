<link href="Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<div class="sCreerAdmin">
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
    <h2><?= $model->etat ?></h2>
</form>
</div>

<?php
    /** @var LoginModel $model */
?>