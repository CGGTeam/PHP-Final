<?php
/** @var LoginModel $model */
?>
<h1>Page login</h1>
<form method="post" action="">
    Username:
    <input name="tbNomUtilisateur" type="text">
    <br/>
    Password:
    <input name="tbMotDePasse" type="password">
    <br/>
    <input type="submit">
</form>
<br/>
<h2><?=$model->etat?></h2>