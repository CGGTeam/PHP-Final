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
                <td>
                    <input class="sTb" id="tbNomUtilisateur" name="tbNomUtilisateur" type="text" required
                           placeholder="Nom D'Utilisateur" pattern="([A-Za-z]{1,2}\.[A-Za-z]{1,23})"
                           title="Nom d'utilisateur de la forme 'pr.nomfamille'. Insensible à la casse.
                           pr: la première lettre de vo.tre.s prénom.s nomfamille: Vo.tre.s nom de famille (en un mot)"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sTb" id="tbMotDePasse" name="tbMotDePasse" type="password" required
                           placeholder="Mot de passe" pattern="([A-Za-z0-9]{3,15})"
                           title="3 à 15 caractères alphanumériques." maxlength="15"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sTb" id="tbNomComplet" name="tbNomComplet" type="text" required
                           placeholder="Nom Complet" pattern="[\\pL\-\ ]+, [\\pL\-\ ]+" minlength="5" maxlength="30"
                           title="Forme: 'Nom.s de famille, Prénom.s'. 5 à 30 caractères"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sTb" id="tbCourriel" name="tbCourriel" type="text" placeholder="Courriel"
                           title="adresse@domaine.tld. 10 à 50 caractères. Facultatif."
                           pattern="[a-z0-9.\-_]+\@\w+\.\w+"
                           minlength="10" maxlength="50"/>
                </td>
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