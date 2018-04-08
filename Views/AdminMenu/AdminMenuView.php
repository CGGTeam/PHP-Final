<?php /** @var Utilisateur $model */
?>
Logged in : <?= $model->nomUtilisateur ?> (Admin)
<br/>
<a href="?controller=AdminMenu&action=EditDocuments">1. Mettre à jour la liste des documents</a><br>
<i>Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer un ou plusieurs docu-ments.</i><br>
<a href="?controller=AdminMenu&action=EditReferences">2. Mettre à jour les tables de référence</a><br>
<i>Cliquez sur le lien ci-dessus si vous désirez ajouter/modifier/retirer une ou plusieurs ses-sions, cours, catégories de document et/ou utilisateurs.</i><br>
<a href="?controller=AdminMenu&action=EditPrivileges"> 3. Assigner les privilèges d'accès aux documents </a><br>
<i>Cliquez sur le lien ci-dessus pour assigner les privilèges d'accès aux documents pour un ou plusieurs utilisateurs.</i><br>
<a href="?controller=AdminMenu&action=EditGroupes">4. Assigner un groupe d'utilisateurs à un cours-session</a><br>
<i>Cliquez sur le lien ci-dessus si vous désirez ajouter une série d'utilisateurs et les assigner à un cours-session existant.</i><br>
<a href="?controller=AdminMenu&action=EditArborescence">5. Reconstruire l'arborescence des documents</a><br>
<i>Cliquez sur le lien ci-dessus si vous désirez effectuer du ménage dans les listes de documents enregistrés.</i><br>
6. Terminer l'application