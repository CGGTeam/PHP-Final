<body>
<?php echo $model->etat ?>
<div id="sCreerAdmin">
    <form id="frmCreerAdmin" method="post" action="index.php?controller=Login&action=creerAdmin">
        <label for="tbNomUtilisateur">Nom D'Utilisateur</label>
        <input id="tbNomUtilisateur" name="tbNomUtilisateur" type="text"/><br/>
        <label for="tbNomComplet">Nom Complet</label>
        <input id="tbNomComplet" name="tbNomComplet" type="text"/><br/>
        <label for="tbCourriel">Courriel</label>
        <input id="tbCourriel" name="tbCourriel" type="text"/><br/>
        <label for="tbMotDePasse">Mot de passe</label>
        <input id="tbMotDePasse" name="tbMotDePasse" type="password"/><br/>
        <input id="btnSoumettre" name="btnSoumettre" type="submit" value="Creer"/>
    </form>
</div>
</body>