<?php
    /** @var LoginModel $model */
?>
<link href="Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<form method="post" action="" class="sForm">
    <table>
        <tr>
            <td colspan="2">
                <h1 class="sTitreFormulaire">
                    Connexion
                </h1>
            </td>
        </tr>
        <tr>
            <td>
                <input class="sTb" name="tbNomUtilisateur" type="text" required placeholder="Utilisateur" maxlength="25"
                       pattern="([A-Za-z]{1,2}\.[A-Za-z]{1,23})|(admin)" title="Nom d'utilisateur de la forme 'pr.nomfamille'. Insensible à la casse.
                           pr: la première lettre de votre prénom (ou de vos prénoms) nomfamille: Votre nom de famille">
            </td>
        </tr>
        <tr>
            <td>
                <input class="sTb" name="tbMotDePasse" type="password" required placeholder="Mot de passe"
                       pattern="([A-Za-z0-9]{3,15})|(admin)"
                       title="3 à 15 caractères alphanumériques" maxlength="15">
            </td>
        </tr>
        <tr>
            <td class="sContSingleButton" colspan="2">
                <button class="sBtn" type="submit">
                    Connexion
                </button>
            </td>
        </tr>
        <?php
            if ($model->etat == EnumEtatsLogin::LOGIN_FAILED) {
                ?>
                <tr>

                    <td>
                        <span class="sErreur"><?= "Le combo nom d'utilisateur/mot de passe est invalide" ?></span>
                    </td>
                </tr>
                <?php
            }
        ?>
    </table>
</form>


