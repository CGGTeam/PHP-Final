<body>
<?php var_dump($model) ?>
<link href="/michael/michael/Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<div id="sCreerAdmin">
    <form id="frmCreerAdmin" method="post" action="index.php?controller=Login&action=CreerAdmin">
        <table>
            <input id="tbNomUtilisateur" name="tbNomUtilisateurAdmin" type="text" placeholder="Nom D'Utilisateur"/><
            <input id="tbNomComplet" name="tbNomCompletAdmin" type="text" placeholder="Nom Complet"/>
            <label for="tbCourriel">Courriel</label>
            <input id="tbCourriel" name="tbCourrielAdmin" type="text"/>
            <label for="tbMotDePasse">Mot de passe</label>
            <input id="tbMotDePasse" name="tbMotDePasseAdmin" type="password"/>
            <input id="btnSoumettre" name="btnSoumettre" type="submit" value="Creer"/>
        </table>
    </form>
</div>
</body>