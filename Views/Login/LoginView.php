<link href="/michael/michael/Views/Login/LoginStyle.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.typekit.net/gij1vpi.css">
<div class="sHeaderLogin">
	<table class="headerTable">
		<tr>
			<td class="d1">
				<span class="hCieName">PaperSensation</span>
			</td>
			<td class="d2">
				<span class="hCentre">Page Connexion</span>
			</td>
			<td class="d3">
				<span class="hDroite">Connexion</span>
			</td>
		</tr>
	</table>
</div>
<div class="sContFormulaire">
	<form method="post" action="">
		<table>
		</table>

		Username:
		<input name="tbNomUtilisateur" type="text">
		<br/> Password:
		<input name="tbMotDePasse" type="password">
		<br/>
		<input type="submit">
	</form>
</div>
<h2><?= $model->etat ?></h2>
<?php
/** @var LoginModel $model */
?>