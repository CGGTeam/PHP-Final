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
                <td><input class="sTb" id="tbNomUtilisateur" name="tbNomUtilisateur" type="text"
                           placeholder="Nom D'Utilisateur"/></td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbNomComplet" name="tbNomComplet" type="text" placeholder="Nom Complet"/>
                </td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbCourriel" name="tbCourriel" type="text" placeholder="Courriel"/></td>
            </tr>
            <tr>
                <td><input class="sTb" id="tbMotDePasse" name="tbMotDePasse" type="password"
                           placeholder="Mot de passe"/></td>
            </tr>
            <tr>
                <td>
                    <button class="sBtn" id="btnSoumettre" name="btnSoumettre" type="submit">
                        Creer
                    </button>
                </td>
            </tr>
        </table>
        <p>
            <?php
                /** @var LoginModel $model */
                switch ($model->etat) {
                    case EnumEtatsUtil::AUCUN_POST :
                        break;
                    case EnumEtatsUtil::SAME_USER :
                        ?>
                        <span class="sErreur">Nom d'utilisateur déjà utilisé</span>
                        <?php
                    
                        break;
                    case EnumEtatsUtil::SAME_EMAIL :
                        ?>
                        <span class="sErreur">Adresse courriel déjà utilisée</span>
                        <?php
                        break;
                    case EnumEtatsUtil::SAME_BOTH :
                        ?>
                        <span class="sErreur">Courriel et nom d'utilisateur utilisés</span>
                        <?php
                        break;
                    case EnumEtatsUtil::ERREUR_BD :
                        ?>
                        <span class="sErreur">Erreur de connection à la base de données</span>
                        <?php
                        break;
                    case EnumEtatsUtil::ADMIN_ADMIN :
                        ?>
                        <span class="sErreur">Le combo admin admin est réservé</span>
                        <?php
                        break;
                }
            ?>
        </p>
    </form>
</div>