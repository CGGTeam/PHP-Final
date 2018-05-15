<link href="Views/EditGroupes/groupesStyles.css" rel="stylesheet" type="text/css">
<div class="container">
    <div>
        <form method="post" onsubmit="return valide();" action="?controller=EditGroupes&action=ValidationCSV"
              enctype="multipart/form-data">
            <label for="fichierCSV">Choisir un fichier CSV</label>
            <input type="file" style="" accept=".csv" id="fichierCSV" name="fichierCSV"/>
            <input type="submit" value="SUBMIT">
        </form>
    </div>
</div>
<script>
    function valide() {
        let extension = document.getElementById('fichierCSV').value.split('.').pop();
        let accept = document.getElementById('fichierCSV').accept;
        if (accept.indexOf(extension) === -1) {
            alert("Le type de fichier est invalide: le fichier doit être un .csv!");
        }
        return accept.indexOf(extension) !== -1;
    }
</script>