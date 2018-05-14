<link href="Views/EditGroupes/groupesStyles.css" rel="stylesheet" type="text/css">
<div class="container">
    <div>
        <form method="post" action="?controller=EditGroupes&action=ValidationCSV" enctype="multipart/form-data">
            <label for="fichierCSV">Choisir un fichier CSV</label>
            <input type="file" style="" accept="text/csv" id="fichierCSV" name="fichierCSV"/>
            <input type="submit" value="SUBMIT">
        </form>
    </div>
</div>