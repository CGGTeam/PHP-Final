<?php
    /** @var LoginModel $model */
?>
<link href="Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<form method="post" action="" class="sForm">
    <h1 data-bind="model.etat">

    </h1>
    <table>
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


<script>
    let data = '<?php echo json_encode($model); ?>';
    $portee.model = JSON.parse(data);
</script>
